
/* =======================================================
 *                  - not in vein -
 * script by Gerard Ferrandez - Ge-1-doot - January 2005
 * http://www.dhteumeuleu.com
 * last update: 1 June 2013 - HTML5 canvas version
 * ------------------------------------------------------
 * Javascript code released under the MIT license
 * http://www.dhteumeuleu.com/LICENSE.html
 * ======================================================= */
 
"use strict";

(function () {
	// ---- private variables ----
	var scr, ctx, pointer, nw, nh, sel, active,
	    diapos  = [],
	    size    = 0,
	    nDiapos = 0,
	    ZOOM    = 4,   // zoom factor
	    speed   = .06; // animation speed
	// ---- screen resize ----
	var resize = function () {
		nw = scr.width;
		nh = scr.height;
		size = (nw - 6 - ((nDiapos + 1) * 6)) / cLeft();
		if (!active && sel) run();
	}
	var cLeft = function() {
		var l = 0;
		for (var k = 0; k < nDiapos; k++){
			var o = diapos[k];
			o.x0 = l;
			o.sx = (o.prev) ? o.prev.x0 + o.prev.dim : 0;
			l += o.dim;
		}
		return l;
	}
	// ---- diapo constructor ----
	var Diapo = function (n, pic, s, x) {
		this.n       = n;
		this.dim     = s;
		this.img     = new Image();
		this.img.src = pic.src;
		this.prev    = n > 0 ? diapos[n - 1] : false;
		this.vz      = 0;
		this.sx      = 0;
		this.x0      = 0;
		this.x1      = x * 2;
		this.zo      = 0;
		this.rImg    = 1;
		this.l       = 0;
		this.w       = 0;
		this.t       = 0;
		this.loaded  = false;
		this.title   = pic.title;
		this.text    = this.wrapText(pic.text, 250, 'normal', 16, 'sans-serif');
	}
	// ---- wrapText ----
	Diapo.prototype.wrapText = function (text, maxWidth, fontStyle, lineHeight, font) {
		var font = ctx.font = fontStyle + ' ' + lineHeight + 'px ' + font;
		var lines = [];
		var line = "";
		var words = text.split(" ");
		for (var n = 0; n < words.length; n++) {
			var testLine = line + words[n] + " ";
			var metrics = ctx.measureText(testLine);
			var testWidth = metrics.width;
			if (testWidth > maxWidth) {
				lines.push(line);
				line = words[n] + " ";
			} else {
				line = testLine;
			}
		}
		lines.push(line);
		return {
			font: font,
			lineHeight: lineHeight,
			lines: lines,
			draw: function (x, y) {
				ctx.font = this.font;
				for (var i = 0, l = this.lines.length; i < l; i++) {
					ctx.fillText(this.lines[i], x, y);
					y += this.lineHeight;
				}
			}
		};
    }
	// ---- draw text ----
	Diapo.prototype.drawText = function (x, y, text) {
		ctx.font = text.font;
		for (var i = 0, l = text.lines.length; i < l; i++) {
			ctx.fillText(text.lines[i], x, y);
			y += text.lineHeight;
		}
	}
	// ---- draw diapo ----
	Diapo.prototype.draw = function () {
		if (this.loaded) {
			// ---- compute positions ----
			var x = this.x1 - this.sx;
			this.vz  = speed * (this.vz + x);
			if (Math.abs(x) > 0.001) active = true;
			this.x1 -= this.vz;
			this.zo -= (this.zo - (this.dim * this.rImg)) * speed;
			this.l   = (this.x1 * size) + 6 * (this.n + 1);
			this.w   = this.zo * size;
			this.t   = (nh * 0.5) - this.w * 0.5;
			// ---- define path ----
			ctx.beginPath();
			ctx.moveTo(this.l, this.t);
			ctx.lineTo(this.l + this.w / this.rImg, this.t);
			ctx.lineTo(this.l + this.w / this.rImg, this.t + this.w);
			ctx.lineTo(this.l, this.t + this.w);
			ctx.closePath();
			// ---- draw image ----
			ctx.drawImage(this.img, this.l, this.t, this.w / this.rImg, this.w);
			// ---- pointer over ----
			if (ctx.isPointInPath(pointer.X, pointer.Y)) {
				if (this != sel){
					sel.dim = 1 / sel.rImg;
					this.dim = ZOOM;
					sel = this;
					cLeft();
					active = true;
				}
			}
		} else {
			// ---- loading image ----
			active = true;
			if (this.img.complete) {
				this.loaded = true;
				this.rImg = this.img.height / this.img.width;
				this.dim = (sel.n === this.n) ? ZOOM : 1 / this.rImg;
				resize();
			}
		}
	}
	// ---- text ----
	Diapo.prototype.drawText = function () {
		if (this.loaded) {
			ctx.fillStyle = "rgb(128,0,0)";
			var y = (this.w * this.rImg) * 0.4;
			if (this.n < nDiapos * 0.5) {
				ctx.textAlign = 'left';
				var x = this.l + this.w / this.rImg + 6;
				// ---- wrap text ----
				this.text.draw(x, (nh * 0.5) - y);
				// ---- title ----
				ctx.font = "bold 48px sans-serif";
				ctx.fillText(this.title, x, (nh * 0.5) + y);
			} else {
				ctx.textAlign = 'right';
				var x = this.l - 6;
				// ---- wrap text ----
				this.text.draw(x, (nh * 0.5) - y);
				// ---- title ----
				ctx.font = "bold 48px sans-serif";
				ctx.fillText(this.title, x, (nh * 0.5) + y);
			}
		}
	}
	//---- init script ----
	var init = function (data) {
		scr = new ge1doot.Screen({
			container: "screen",
			resize: function () {
				resize();
			}
		});
		ctx = scr.ctx;
		// ---- create diapos ----
		nDiapos  = data.pics.length;
		var s = ZOOM;
		var x = 0;
		for (var i = 0; i < nDiapos; i++) {
			diapos.push(
				new Diapo(i, data.pics[i], s, x)
			);
			x += s;
			s = 1;
		}
		// ---- pointer events ----
		pointer = new ge1doot.Pointer({
			tap: function () {
				if (!active && sel) run();
			},
			move: function () {
				if (!active && sel) run();
			}
		});
		// ---- start ----
		setTimeout(function () {
			sel = diapos[0];
			scr.resize();
		}, 500);
	}
	// ======== main loop ========
	var run = function () {
		// ---- clear screen ----
		ctx.clearRect(0, 0, scr.width, scr.height);
		// ---- draw diapos ----
		active = false;
		for (
			var k = 0;
			k < nDiapos;
			diapos[k++].draw()
		);
		// ---- draw text ----
		sel.drawText();
		// ---- next frame ----
		if (active) requestAnimFrame(run);
	}
	return {
		// ---- onload event ----
		load : function (data) {
			window.addEventListener('load', function () {
				init(data);
			}, false);
		}
	}
})().load({
	pics: [
		{src: "imagens/galeria000.jpg",     title: "FootBox Game",     text: "Um jogo para toda a família."},
		{src: "imagens/galeria006.jpg",     title: "Projeto Lab",      text: "Um labirinto de emoções.[em desenvol.]"},
		{src: "imagens/galeria007.jpg",     title: "Projeto Cormaya",     text: "Baseado no mapa do Tibia.[em desenvol.]"},
		{src: "imagens/galeria008.jpg",     title: "Idiomas",     text: "Dois idiomas oficiais."},
		{src: "imagens/galeria004.jpg",     title: "Bonus",     text: "Sistema de pontuação extra"},
		{src: "imagens/galeria009.jpg",     title: "Estruturas",     text: "Acesso completo aos mapas"},
		

	]
});
