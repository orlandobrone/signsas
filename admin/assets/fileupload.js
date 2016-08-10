if (typeof Object.create !== "function") {
    function C() {}
    Object.create = function (a) {
        C.prototype = a;
        return new C()
    }
}(function (d, b, a, e) {
    d.fn.FileUploader = function (f) {
        return this.each(function () {
            var g = Object.create(c);
            g.init(d(this), f)
        })
    };
    d.fn.FileUploader.Options = {
        onInit: null,
        onEnqueue: null,
        onDequeue: null,
        onClearAll: null,
        onUploadStart: null,
        onUploadFail: null,
        onUploadComplete: null,
        onAllComplete: null,
        msg: {
            extTitle: "Error - File Type",
            extError: "This file type isn't allowed",
            sizeTitle: "Error - File Size",
            sizeError: "This file is too large",
            dropFiles: "YTou can drop your file(s) here",
            ierror: "Error"
        },
        maxAllowedFiles: null,
        allowedTypes: null,
        maxFileSize: null,
		datatype: null,
        url: "controller.php",
        knownExtensions: ["png", "gif", "xls", "xlsx", "doc", "docx", "jpg", "jpeg", "txt", "zip", "rar", "exe", "bmp", "html", "html", "pdf", "pps", "ppsx", "psd"]
    };
    d.fn.FileUploader.States = {
        QUEUED: "queued",
        PROGRESSING: "progressing",
        UPLOADING: "uploading",
        FINISHED: "completed",
        FAILED: "failed"
    };
    d.fn.FileUploader.Instances = [];
    var c = {
        options: {},
        domHandles: {},
        queuedFiles: [],
        filesCount: 0,
        unknownFile: "unknown",
        id: null,
        isIE6: d.browser.msie && d.browser.version == "6.0",
        isIE7: d.browser.msie && d.browser.version == "7.0",
        isIE8: d.browser.msie && d.browser.version == "8.0",
        isIE9: d.browser.msie && d.browser.version == "9.0",
		isIE10: d.browser.msie && d.browser.version == "10.0",
		isIOS: navigator.userAgent.match(/(iPod|iPhone|iPad|Android)/),
        init: function (h, g, i) {
            var f = this;
            this.options = d.extend({}, d.fn.FileUploader.Options, g);
            this.domHandles.container = h;
            this.domHandles.message = h.find("p.message");
            this.domHandles.uploadSpace = h.find(".uploadspace");
            this.domHandles.addButton = h.find(".addbutton");
            this.domHandles.clearButton = h.find(".clearbutton").click(function (j) {
                j.preventDefault();
                f.clear()
            });
            this.domHandles.startButton = h.find(".startbutton").click(function (j) {
                j.preventDefault();
                f.start()
            });
            this.domHandles.addButton.find("input").bind("change", function (j) {
                j.preventDefault();
                f.enqueue()
            });
            this.domHandles.dragSpace = h.find(".dragspace").bind("dragover dragleave", function (j) {
                f.handleDragHover(j)
            }).bind("drop", function (j) {
                f.handleFileDrop(j)
            });
            (this.canAjaxUpload() ? this.domHandles.dragSpace : this.domHandles.addButton).removeClass("hidden");
            this.id = d.fn.FileUploader.Instances.length + "-" + (new Date).getTime();
            d.fn.FileUploader.Instances[this.id] = this;
            if (this.options.onInit) {
                setTimeout(function () {
                    f.options.onInit(this)
                }, 1)
            }
        },
        updateMessage: function () {
            var g = "Unlimited files ";
            if (this.options.maxAllowedFiles != null) {
                g = this.options.maxAllowedFiles + " file" + (this.options.maxAllowedFiles != 1 ? "(s)" : "")
            }
            if (this.options.allowedTypes != null) {
                for (var f = 0; f < this.options.allowedTypes.length; f++) {
                    if (f == 0) {
                        g += " of type" + (this.options.allowedTypes != 1 ? "(s)" : "")
                    } else {
                        g += " *." + this.options.allowedTypes[f]
                    }
                }
                g += " allowed."
            } else {
                g += " of any type allowed."
            }
            if (this.options.maxFileSize != null) {
                g += "<br/>Maximum file size is " + this.bytesToMegaBytes(this.options.maxFileSize) + "."
            }
            this.domHandles.message.html(g)
        },
        canAjaxUpload: function () {
            return (!this.isIOS && !this.isIE6 && !this.isIE7 && !this.isIE8 && !this.isIE9 && !this.isIE10 && !d.browser.opera && !(d.browser.safari && navigator.vendor.indexOf("Google") == -1 && navigator.platform == "Win32") && !(d.browser.mozilla && parseInt(d.browser.version, 10) < 3.6))
        },
        handleFileDrop: function (h) {
            h.preventDefault();
            var g = h.originalEvent.dataTransfer.files;
            for (var f = 0; f < g.length; f++) {
                this.enqueue(g[f])
            }
            this.handleDragHover(h)
        },
        handleDragHover: function (g) {
            g.stopPropagation();
            g.preventDefault();
            var f = this.domHandles.dragSpace.find(".zonemessage");
            if (g.type == "dragover") {
                this.domHandles.dragSpace.addClass("hover");
                if (f.data("text") == null) {
                    f.data("text", f.text()).text(this.options.msg.dropFiles)
                }
            } else {
                this.domHandles.dragSpace.removeClass("hover");
                f.text(f.data("text"));
                f.removeData("text")
            }
        },
        onComplete: function (g) {
            var f = this;
            var h = g.file;
            if (g.success) {
                this.markFileComplete(h);
                if (this.options.onUploadComplete) {
                    setTimeout(function () {
                        f.options.onUploadComplete(h)
                    }, 1)
                }
            } else {
                this.markFileFailed(h, g.message);
                if (this.options.onUploadFail) {
                    setTimeout(function () {
                        f.options.onUploadFail(h)
                    }, 1)
                }
            }
            this.upload()
        },
        onAllComplete: function () {
            var f = this;
            this.domHandles.clearButton.removeClass("hidden");
            if (this.options.onAllComplete) {
                setTimeout(function () {
                    f.options.onAllComplete(this)
                }, 1)
            }
        },
        markFileComplete: function (h) {
            for (var g in this.queuedFiles) {
                var f = this.queuedFiles[g];
                if (f.id == h.id) {
                    f.state = d.fn.FileUploader.States.FINISHED;
                    break
                }
            }
            d("." + f.id).remove();
            d("#" + f.id + " .indicator").removeClass("uploading").addClass("done");
            d("#" + f.id + "state").text(d.fn.FileUploader.States.FINISHED);
            d("#" + f.id + "size").text(this.bytesToMegaBytes(h.size))
        },
        markFileFailed: function (j, f) {
            for (var h in this.queuedFiles) {
                var g = this.queuedFiles[h];
                if (g.id == j.id) {
                    g.state = d.fn.FileUploader.States.FINISHED;
                    break
                }
            }
            d("." + g.id).remove();
            d("#" + g.id + " .indicator").removeClass("uploading").addClass("failed");
            d("#" + g.id + "state").text(d.fn.FileUploader.States.FAILED);
            d("#" + g.id + "size").text(this.bytesToMegaBytes(j.size));
            d("#" + g.id).after('<p class="failedupload msgError"><span>' + this.options.msg.ierror + "</span>" + f + "</p>")
        },
        markFileUploading: function (f) {
            f.state = d.fn.FileUploader.States.UPLOADING;
            d("#" + f.id + " .indicator").addClass("uploading");
            d("#" + f.id + "state").text(d.fn.FileUploader.States.UPLOADING)
        },
        markFileprogressing: function (g) {
            var f = d("<a></a>").attr({
                "class": "indicator"
            });
            g.state = d.fn.FileUploader.States.PROGRESSING;
            if (d.browser.msie && d.browser.version == "6.0") {
                f.addClass("ie6")
            }
            d("#" + g.id).append(f);
            d("#" + g.id + "state").text(d.fn.FileUploader.States.PROGRESSING)
        },
        isQueueFull: function () {
            var g = 0;
            for (var f = 0; f < this.queuedFiles.length; f++) {
                g += (this.queuedFiles[f].state == d.fn.FileUploader.States.QUEUED ? 1 : 0)
            }
            return this.options.maxAllowedFiles != null && g == this.options.maxAllowedFiles
        },
        enqueue: function (h) {
            var f = this;
            if (this.isQueueFull()) {
                this.dontAcceptFiles();
                return
            }
            var g = this.readFile(h);
            if (this.isAllowedType(g) == false) {
                d.confirm({
                    title: this.options.msg.extTitle,
                    message: '<div><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>' + this.options.msg.extError + "</div>",
                    buttons: {
                        Close: {
                            "class": "no"
                        }
                    }
                });
                return false
            }
            if (this.options.maxFileSize != null && g.size != this.unknownFile && g.size > this.options.maxFileSize) {
                d.confirm({
                    title: this.options.msg.sizeTitle,
                    message: '<div><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>' + this.options.msg.sizeError + "</div>",
                    buttons: {
                        Close: {
                            "class": "no"
                        }
                    }
                });
                return false
            }
            this.addToQueue(g);
            this.renderFile(this.queuedFiles[this.filesCount - 1], this.filesCount - 1);
            this.showUploadButton();
            if (this.isQueueFull()) {
                this.dontAcceptFiles()
            }
            if (this.options.onEnqueue) {
                setTimeout(function () {
                    f.options.onEnqueue(g)
                }, 1)
            }
        },
        dequeue: function (k) {
            var f = this;
            var g = d("#" + k);
            g.slideUp(50, function () {
                g.remove()
            });
            for (var j in this.queuedFiles) {
                if (this.queuedFiles[j].id == k) {
                    var h = this.queuedFiles.splice(j, 1);
                    break
                }
            }
            this.filesCount--;
            this.hideUploadButton();
            this.acceptFiles();
            if (this.filesCount == 0) {
                this.domHandles.uploadSpace.addClass("hidden")
            }
            if (h && this.options.onDequeue) {
                setTimeout(function () {
                    f.options.onDequeue(h)
                }, 1)
            }
        },
        clear: function () {
            var f = this;
            for (var g = this.filesCount - 1; g >= 0; g--) {
                this.dequeue(this.queuedFiles[g].id)
            }
            this.domHandles.uploadSpace.empty().addClass("hidden");
            this.hideUploadButton();
            this.acceptFiles();
            if (this.options.onClearAll) {
                setTimeout(function () {
                    f.options.onClearAll(this)
                }, 1)
            }
        },
        updateStatus: function () {
            for (var g in this.queuedFiles) {
                var f = this.queuedFiles[g];
                if (f.state == d.fn.FileUploader.States.QUEUED) {
                    this.markFileprogressing(f)
                }
            }
        },
        hideButtons: function () {
            this.domHandles.addButton.addClass("hidden");
            this.domHandles.startButton.addClass("hidden");
            this.domHandles.clearButton.addClass("hidden")
        },
        hideDeleteButtons: function () {
            this.domHandles.container.find(".file .close").remove()
        },
        start: function () {
            if (this.options.onUploadStart) {
                if (!this.options.onUploadStart(this)) {
                    return
                }
            }
            this.dontAcceptFiles();
            this.hideButtons();
            this.hideUploadButton();
            this.hideDeleteButtons();
            this.updateStatus();
            this.upload()
        },
        upload: function () {
            var h = this.getNextFileToUpload();
            if (h == null) {
                this.onAllComplete();
                return
            }
            this.markFileUploading(h);
            if (this.canAjaxUpload()) {
                var f = this;
                var k = new FormData();
                k.append("fileid", h.id);
                k.append("filedata", h.handle);
                h.request = d.ajax({
                    url: this.options.url,
                    type: "POST",
					dataType: this.options.datatype,
                    data: k,
                    processData: false,
                    contentType: false
                }).done(function (m) {
                    b.setTimeout(function () {
                        f.onComplete(m)
                    }, 1)
                })
            } else {
                var j = h.element.attr({
                    "class": "offscreen",
                    target: h.id
                });
                var l = d("<input />").attr({
                    type: "hidden",
                    value: h.id,
                    name: "fileid"
                });
                var g = d("<input />").attr({
                    type: "hidden",
                    value: this.id,
                    name: "instanceid"
                });
                var i = null;
                if (this.isIE6 || this.isIE7 || this.isIE8) {
                    i = d(a.createElement('<iframe name="' + h.id + '">'))
                } else {
                    i = d(a.createElement("iframe"));
                    i.attr("name", h.id)
                }
                i.attr({
                    width: "30",
                    height: "30",
                    "class": "offscreen"
                });
                j.append(l);
                j.append(g);
                j.parent().append(i);
                j[0].submit()
            }
        },
        getNextFileToUpload: function () {
            for (var f = this.queuedFiles.length - 1; f >= 0; f--) {
                if (this.queuedFiles[f].state == d.fn.FileUploader.States.PROGRESSING) {
                    return this.queuedFiles[f]
                }
            }
            return null
        },
        addToQueue: function (h) {
            var f = this;
            this.queuedFiles[this.filesCount] = h;
            this.filesCount++;
            if (!this.canAjaxUpload()) {
                var i = this.domHandles.addButton.find("form");
                var g = this.domHandles.addButton.clone();
                g.find("form")[0].reset();
                this.domHandles.addButton.attr({
                    "class": h.id + " hidden",
                    id: ""
                });
                this.domHandles.addButton.after(g);
                this.domHandles.addButton = g;
                this.domHandles.addButton.find("input").bind("change", function (j) {
                    j.preventDefault();
                    f.enqueue()
                })
            }
        },
        readFile: function (i) {
            var m = new Date().getTime();
            var g = "";
            var h = "";
            var j = this.domHandles.addButton.find("form");
            if (d.browser.msie || d.browser.opera) {
                var k = j.find("input[type=file]");
                var f = k.val().split("\\");
                var l = f[f.length - 1];
                g = l;
                h = this.unknownFile
            } else {
                if (!this.canAjaxUpload()) {
                    i = this.domHandles.addButton.find("input[type=file]")[0].files[0]
                }
                g = i.fileName || i.name;
                h = i.fileSize || i.size
            }
            return {
                id: m,
                name: g,
                size: h,
                type: this.getFileType(g),
                element: j,
                state: d.fn.FileUploader.States.QUEUED,
                handle: i
            }
        },
        showUploadButton: function () {
            (this.canAjaxUpload() ? this.domHandles.dragSpace : this.domHandles.startButton).removeClass("hidden");
            if (this.filesCount > 0) {
                this.domHandles.clearButton.removeClass("hidden");
                this.domHandles.startButton.removeClass("hidden")
            }
        },
        hideUploadButton: function () {
            for (var g in this.queuedFiles) {
                var f = this.queuedFiles[g];
                if (f.state == d.fn.FileUploader.States.QUEUED) {
                    return
                }
            }
            this.domHandles.startButton.addClass("hidden");
            if (this.filesCount == 0) {
                this.domHandles.clearButton.addClass("hidden")
            }
        },
        acceptFiles: function () {
            (this.canAjaxUpload() ? this.domHandles.dragSpace : this.domHandles.addButton).removeClass("hidden")
        },
        dontAcceptFiles: function () {
            (this.canAjaxUpload() ? this.domHandles.dragSpace : this.domHandles.addButton).addClass("hidden")
        },
        getFileType: function (j) {
            var h = this.getFileExtension(j);
            var g = this.options.knownExtensions;
            for (var f in g) {
                if (g[f] == h) {
                    return h
                }
            }
            return this.unknownFile
        },
        getFileExtension: function (g) {
            var f = g.split(".");
            if (f.length <= 1) {
                return this.unknownFile
            }
            return f[f.length - 1].toLowerCase()
        },
        renderFile: function (h, i) {
            var m = this;
            var o = "pending";
            var j = "unknown";
            if (!d.browser.msie && !d.browser.opera) {
                o = this.bytesToMegaBytes(h.size);
                j = h.type
            }
            var g = d("<span>" + h.name + "</span>").attr("class", "title");
            var n = d("<div></div>").attr({
                id: h.id,
                "class": "file " + h.type
            });
            var l = d("<p></p>").attr("class", "fileinfo");
            l.append("<span class=meta>size:</span><span id=" + h.id + "size >" + o + "</span>");
            l.append("<span class=meta>type:</span><span>" + this.getFileExtension(h.name) + "</span>");
            var f = d("<span class=meta>state:</span><span id=" + h.id + "state >" + h.state + "</span>");
            var k = d("<a></a>").text(" ").attr({
                "class": "close",
                href: "#"
            }).click(function (p) {
                p.stopPropagation();
                p.preventDefault();
                m.dequeue(h.id)
            });
            if (d.browser.msie && d.browser.version == "6.0") {
                k.addClass("ie6")
            }
            l.append(f);
            n.append(g);
            n.append(l);
            n.append(k);
            this.domHandles.uploadSpace.prepend(n).removeClass("hidden");
            h.statusindicator = f
        },
        bytesToMegaBytes: function (f) {
            if (f < 1024) {
                return f + " bytes"
            } else {
                if (f < 1024 * 1024) {
                    return Math.floor(f / 1024, 2) + " KB"
                } else {
                    return Math.floor(f / (1024 * 1024), 2) + " MB"
                }
            }
        },
        isAllowedType: function (g) {
            if (this.options.allowedTypes == null) {
                return true
            }
            for (var f = 0; f < this.options.allowedTypes.length; f++) {
                if (this.options.allowedTypes[f] == g.type) {
                    return true
                }
            }
            return false
        }
    }
})(jQuery, window, document);