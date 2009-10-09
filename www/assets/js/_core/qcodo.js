///////////////////////////////////////////////////
// The Qcodo Object is used for everything in Qcodo
///////////////////////////////////////////////////

	var qcodo = {
		initialize: function() {

		////////////////////////////////
		// Browser-related functionality
		////////////////////////////////

			this.isBrowser = function(intBrowserType) {
				return (intBrowserType & qcodo._intBrowserType);
			}
			this.IE = 1;
			this.FIREFOX = 2;
			this.SAFARI = 4;
			this.MACINTOSH = 8;
			this.OTHER = 16;
			this._intBrowserType = this.OTHER;

			if (navigator.userAgent.toLowerCase().indexOf("msie") >= 0) {
				this._intBrowserType = this.IE;
			} else if (navigator.userAgent.toLowerCase().indexOf("firefox") >= 0) {
				this._intBrowserType = this.FIREFOX;
			} else if (navigator.userAgent.toLowerCase().indexOf("safari") >= 0) {
				this._intBrowserType = this.SAFARI;
			} else {
				this._intBrowserType = this.OTHER;
			}
			
			if (navigator.userAgent.toLowerCase().indexOf("macintosh") >= 0)
				this._intBrowserType = this._intBrowserType | this.MACINTOSH;



		/////////////////////////////
		// QForm-related functionality
		/////////////////////////////

			this.registerForm = function() {
				// "Lookup" the QForm's FormId
				var strFormId = document.getElementById("Qform__FormId").value;

				// Register the Various Hidden Form Elements needed for QForms
				this.registerFormHiddenElement("Qform__FormControl", strFormId);
				this.registerFormHiddenElement("Qform__FormEvent", strFormId);
				this.registerFormHiddenElement("Qform__FormParameter", strFormId);
				this.registerFormHiddenElement("Qform__FormCallType", strFormId);
				this.registerFormHiddenElement("Qform__FormUpdates", strFormId);
				this.registerFormHiddenElement("Qform__FormCheckableControls", strFormId);
			}

			this.registerFormHiddenElement = function(strId, strFormId) {
				var objHiddenElement = document.createElement("input");
				objHiddenElement.type = "hidden";
				objHiddenElement.id = strId;
				objHiddenElement.name = strId;
				document.getElementById(strFormId).appendChild(objHiddenElement);
			}

			this.wrappers = new Array();



		////////////////////////////////////
		// Mouse Drag Handling Functionality
		////////////////////////////////////

			this.enableMouseDrag = function() {
				document.onmousedown = qcodo.handleMouseDown;
				document.onmousemove = qcodo.handleMouseMove;
				document.onmouseup = qcodo.handleMouseUp;
			}

			this.handleMouseDown = function(objEvent) {
				objEvent = qcodo.handleEvent(objEvent);

				var objHandle = qcodo.target;
				if (!objHandle) return true;

				var objWrapper = objHandle.wrapper;
				if (!objWrapper) return true;

				// Qcodo-Wide Mouse Handling Functions only operate on the Left Mouse Button
				// (Control-specific events can respond to QRightMouse-based Events)
				if (qcodo.mouse.left) {
					if (objWrapper.handleMouseDown) {
						// Specifically for Microsoft IE
						if (objHandle.setCapture)
							objHandle.setCapture()

						// Ensure the Cleanliness of Dragging
						objHandle.onmouseout = null;
						if (document.selection)
							document.selection.empty();

						qcodo.currentMouseHandleControl = objWrapper;
						return objWrapper.handleMouseDown(objEvent, objHandle);
					}
				}

				qcodo.currentMouseHandleControl = null;
				return true;
			}

			this.handleMouseMove = function(objEvent) {
				objEvent = qcodo.handleEvent(objEvent);

				if (qcodo.currentMouseHandleControl) {
					var objWrapper = qcodo.currentMouseHandleControl;
					var objHandle = objWrapper.handle;

					// In case IE accidentally marks a selection...
					if (document.selection)
						document.selection.empty();

					if (objWrapper.handleMouseMove)
						return objWrapper.handleMouseMove(objEvent, objHandle);
				}

				return true;
			}

			this.handleMouseUp = function(objEvent) {
				objEvent = qcodo.handleEvent(objEvent);

				if (qcodo.currentMouseHandleControl) {
					var objWrapper = qcodo.currentMouseHandleControl;
					var objHandle = objWrapper.handle;

					// In case IE accidentally marks a selection...
					if (document.selection)
						document.selection.empty();

					// For IE to release release/setCapture
					if (objHandle.releaseCapture) {
						objHandle.releaseCapture();
						objHandle.onmouseout = function() {this.releaseCapture()};
					}

					qcodo.currentMouseHandleControl = null;

					if (objWrapper.handleMouseUp)
						return objWrapper.handleMouseUp(objEvent, objHandle);
				}

				return true;
			}
		}
	}



////////////////////////////////
// Qcodo Shortcut and Initialize
////////////////////////////////

	var qc = qcodo;
	qc.initialize();
