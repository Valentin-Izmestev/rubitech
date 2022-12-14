BX.namespace("BX.UI");

BX.UI.InfoHelper =
{
	frameUrlTemplate : '',
	frameNode : null,
	popupLoader : null,
	frameUrl: "",
	inited: false,

	init : function(params)
	{
		this.inited = true;
		this.frameUrlTemplate = params.frameUrlTemplate || '';


		BX.bind(window, 'message', BX.proxy(function(event)
		{
			if (!!event.origin && event.origin.indexOf('bitrix') === -1)
			{
				return;
			}

			if (!event.data || typeof(event.data) !== "object")
			{
				return;
			}

			if (event.data.action === "ClosePage")
			{
				this.close();
			}

			if (event.data.action === "openPage")
			{
				window.location.href = this.frameUrl;
			}

			if (event.data.action === "openPageInNewTab")
			{
				window.open(this.frameUrl,'_blank');
			}

			if (event.data.action === 'reloadParent')
			{
				this.reloadParent();
			}

			if (event.data.action === 'openSlider' && !!event.data.url)
			{
				top.BX.SidePanel.Instance.open(event.data.url);
			}

			if (event.data.action === 'openInformer' && !!event.data.code && !!event.data.option)
			{
				top.BX.UI.InfoHelper.__showExternal(
					event.data.code,
					event.data.option
				);
			}

			if (event.data.action === 'activateDemoSubscription')
			{
				if (event.data.licenseAgreed === 'Y')
				{
					var ajaxRestPath = '/bitrix/tools/rest.php';
					var callback = function(result)
					{
						var slider = BX.SidePanel.Instance.getTopSlider();
						if (slider)
						{
							BX.UI.InfoHelper.frameNode.contentWindow.postMessage(
								{
									action: 'onActivateDemoSubscriptionResult',
									result:result
								},
								'*'
							);
						}
					}.bind(this);

					BX.ajax(
						{
							dataType: 'json',
							method: 'POST',
							url: ajaxRestPath,
							data: {
								action: 'activate_demo',
								sessid: BX.bitrix_sessid()
							},
							onsuccess: callback,
							onfailure: function(error_type, error)
							{
								callback({error: error_type + (!!error ? ': ' + error : '')});
							}
						}
					);
				}
			}

			if (event.data.action === 'activateDemoLicense')
			{
				BX.ajax.runAction("ui.infoHelper.activateDemoLicense").then(
					function(response)
					{
						var slider = BX.SidePanel.Instance.getTopSlider();
						if (slider)
						{
							BX.UI.InfoHelper.frameNode.contentWindow.postMessage(
								{
									action: 'onActivateDemoLicenseResult',
									result: response
								},
								'*'
							);
						}
					}.bind(this)
				);
			}

			if (event.data.action === 'openBuySubscriptionPage')
			{
				BX.ajax.runAction("ui.infoHelper.getBuySubscriptionUrl").then(
					function(response)
					{
						if (!!response.data && !!response.data.url)
						{
							if (response.data.action === 'blank')
							{
								window.open(response.data.url, '_blank');
							}
							else if (response.data.action === 'redirect')
							{
								window.location.href = response.data.url;
							}
						}
					}.bind(this)
				);
			}


		}, this));
	},

	__showExternal: function(code, option)
	{
		var width = 700;
		var sliderId = this.getSliderId() + ':' + code;
		var frame = BX.create('iframe', {
			attrs: {
				className: 'info-helper-panel-iframe',
				src: "about:blank"
			}
		});
		if (!!option && !!option.width && option.width > 0)
		{
			width = option.width;
		}
		BX.SidePanel.Instance.open(
			sliderId,
			{
				contentCallback: function(slider) {
					return new Promise(function(resolve, reject) {
						BX.ajax.runAction("ui.infoHelper.getInitParams").then(function(response)
						{
							frame.src = this.frameUrlTemplate.replace(/code/, code);

							resolve(
								BX.create('div', {
									attrs: {
										className: 'info-helper-container',
										id: "info-helper-container"
									},
									children: [
										this.getLoader(),
										frame
									]
								})
							);
						}.bind(this));
					}.bind(this));
				}.bind(this),
				width: width,
				loader: 'default-loader',
				cacheable: false,
				data: { rightBoundary: 0 },
				events: {
					onLoad: function () {
						BX.UI.InfoHelper.showFrame(frame);
					},
				}
			});
	},

	show: function(code)
	{
		if (this.isOpen())
		{
			return;
		}


		if (!code)
		{
			return;
		}

		BX.SidePanel.Instance.open(this.getSliderId(), {
			contentCallback: function(slider) {
				return new Promise(function(resolve, reject) {
					BX.ajax.runAction("ui.infoHelper.getInitParams").then(function(response)
					{
						this.init(response.data);
						this.frameUrl = this.frameUrlTemplate.replace(/code/, code);


						if (this.getFrame().src !== this.frameUrl)
						{
							this.getFrame().src = this.frameUrl;
						}

						resolve(this.getContent());
					}.bind(this));
				}.bind(this));
			}.bind(this),
			width: 700,
			loader: 'default-loader',
			cacheable: false,
			data: { rightBoundary: 0 },
			events: {
				onCloseComplete: function() {
					BX.UI.InfoHelper.close();
				},
				onLoad: function () {
					BX.UI.InfoHelper.showFrame();
				},
				onClose: function () {
					BX.UI.InfoHelper.frameNode.contentWindow.postMessage({action: 'onCloseWidget'}, '*');
				}
			}
		});
	},

	close: function()
	{
		var slider = this.getSlider();
		if (slider)
		{
			slider.close();
		}
	},

	getContent: function()
	{
		if (this.content)
		{
			return this.content;
		}

		this.content = BX.create('div', {
			attrs: {
				className: 'info-helper-container',
				id: "info-helper-container"
			},
			children: [
				this.getLoader(),
				this.getFrame()
			]
		});
		return this.content;
	},

	getFrame: function()
	{
		if (this.frameNode)
		{
			return this.frameNode;
		}

		this.frameNode = BX.create('iframe', {
			attrs: {
				className: 'info-helper-panel-iframe',
				src: "about:blank"
			}
		});

		return this.frameNode;
	},

	showFrame: function(frame)
	{
		if (!frame)
		{
			frame = this.getFrame();
		}
		setTimeout(function(){
			frame.classList.add("info-helper-panel-iframe-show");
		}.bind(this), 600);
	},

	getLoader: function()
	{
		if (this.popupLoader)
		{
			return this.popupLoader;
		}

		var loader = new BX.Loader({
			target: BX("info-helper-container"),
			size: 100
		});

		loader.show();
		this.popupLoader = loader.data.container;

		return this.popupLoader;
	},

	getSliderId: function()
	{
		return "ui:info_helper";
	},

	getSlider: function()
	{
		return BX.SidePanel.Instance.getSlider(this.getSliderId());
	},

	reloadParent: function()
	{
		var slider = false;
		var sliderTop = BX.SidePanel.Instance.getTopSlider();
		if (!!sliderTop)
		{
			slider = BX.SidePanel.Instance.getPreviousSlider(sliderTop);
		}

		if (!!slider)
		{
			slider.reload();
		}
		else
		{
			window.location.reload();
		}

		return true;
	},

	isOpen: function()
	{
		return this.getSlider() && this.getSlider().isOpen();
	},

	isInited: function ()
	{
		return this.inited;
	},
};