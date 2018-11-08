export default class BGsrcset {
	constructor () {
		this.called = false;
		this.callonce = true;
		this.compat();
	}

	init (target, callback) {
		//retina bool
		this.retina = window.devicePixelRatio > 1;

		//storage for our elements
		this.elements = [];

		//global onload callback for imagery
		this.callback = typeof callback === "function" ? callback : function () { };

		//window width, for responsive handling
		this.curwidth = this.getWidth();

		//get our input and turn it into an element list of some sort
		let elems = this.gather(target);

		//parse the element input
		for (let i = 0, l = elems.length; i < l; i++) {
			this.parse(elems[i]);
		}

		this.set();
		this.resize();
	}

	// Fix compatibility issues *only down to IE8*
	compat () {
		const d = document

		// check for getElementsByClassName
		if (typeof d.getElementsByClassName !== "function") {
			d.getElementsByClassName = str => {
				return d.querySelectorAll("." + str)
			}
		}

		// check for .trim()
		if (!String.prototype.trim) {
			String.prototype.trim = () => {
				return this.replace(/^\s+|\s+$/g, "");
			};
		}

    // Check for Event Listener
		if (!d.addEventListener) {
			this.addEvent = (elem, evName, fn) => {
				elem.attachEvent("on" + evName, function (e) {
					fn(e || window.event);
				});
			};
		}
	}

	gather (target) {
		const autotypes = ["HTMLCollection", "NodeList"]
		const e = target;
		const type = e.nodeType
			? "Object"
			: Object.prototype.toString.call(e).replace(/^\[object |\]$/g, "")

		const func = "parse" + type

		if (autotypes.indexOf(type) > -1) {
			return e
		}

		if (this[func]) {
			return this[func](e);
		}

		return []
	}

	parseObject (target) { target.nodeType ? [target] : [] }
	parseArray (target) { target }
	parseString (target) {
		const d = document
		let e = target.trim()
		let sel = e[0]
		let elems = []

		switch (true) {
			/* class */
			case sel === ".":
				elems = d.getElementsByClassName(e.substring(1));
				break;
			/* id */
			case sel === "#":
				elems.push(d.getElementById(e.substring(1)));
				break;
			/* tag */
			case /^[a-zA-Z]+$/.test(e):
				elems = d.getElementsByTagName(e);
				break;
			/* unknown */
			default:
				elems = [];
		}

		return elems
	}
	parse (obj) {
		//our data to parase
		const bgss = obj.getAttribute("bg-srcset");
		/* exit if no attribute */
		if (attr === null) { return false }

		/* create new element object */
		this.elements.push({})

		/* split up sets */
		let set = bgss.split(",")
		let attr = ""
		let curelem = this.elements[this.elements.length - 1]

		curelem.node = obj
		curelem.srcset = []

		/* loop through sets to define breakpoints */
		for (let i = 0, l = set.length; i < l; i++) {
			curelem.srcset.push({})
			attr = set[i].trim()
			let attrs = attr.split(" ")
			let a;
			let e;
			let t;
			/* since we can't know the order of the values, starting another loop */
			for (let attrc = 0, attrl = attrs.length; attrc < attrl; attrc++) {
				a = attrs[attrc];
				e = curelem.srcset[i]; //current attribute
				t = a.length - 1;
				switch (true) {
					case a.trim() === "":
						//in case of extra white spaces
						continue;
					case a[t] !== "w" && a[a.length - 1] !== "x":
						e.src = a;
						break;
					case a[t] === "w":
						e.width = parseInt(a.slice(0, -1));
						break;
					case a[t] === "x":
						e.retina = parseInt(a.slice(0, -1)) > 1;
						break;
				}
				if (!e.width) {
					e.width = Number.POSITIVE_INFINITY;
				} //set to the top
				if (!e.retina) {
					e.retina = false;
				}
			}
		}
	}

	set () {
		for (let i = 0, l = this.elements.length; i < l; i++) {
			this.setSingle(i);
		}
	}

	setSingle (id) {
		let width = 0
		let elem = this.elements[id]
		let comparray = []
		let best = 0

		width = this.getWidth() // elem.node.offsetWidth;

		elem.srcset = elem.srcset.sort(dynamicSort("width"));

		for (let i = 0, l = elem.srcset.length; i < l; i++) {
			if (elem.srcset[i].width < width) {
				continue;
			}
			comparray.push(elem.srcset[i]);
		}
		if (comparray.length === 0) {
			comparray.push(elem.srcset[elem.srcset.length - 1]);
		}

		best = comparray[0];

		if (comparray.length > 1 && comparray[0].width === comparray[1].width) {
			best = comparray[0].retina !== this.retina ? comparray[1] : comparray[0];
		}

		if (best.src !== undefined && best.src !== "null") {
			let img = new Image()
			let done = false

			img.onload = img.onreadystatechange = () => {
				if (
					!done &&
					(!this.readyState ||
						this.readyState === "loaded" ||
						this.readyState === "complete")
				) {
					done = true;

					elem.node.style.backgroundImage = "url('" + best.src + "')";

					/* only fire the callback on initial load, not resize events */
					if (!this.called) {
						this.callback(elem);
						this.called = this.callonce;
					}
				}
			};

			img.src = best.src;
		} else {
			elem.node.style.backgroundImage = "";
		}
	}

	resize () {
		let	resizeTimer = setTimeout(() => {}, 0);

		this.addEvent(window, "resize", () => {
			clearTimeout(resizeTimer)
			resizeTimer = setTimeout(() => {
				let w = this.getWidth()
				if (w !== this.curwidth) {
					this.curwidth = w
					this.set()
				}
			}, 250)
		})
	}

	addEvent (elem, evName, fn)  {
		elem.addEventListener(evName, fn, false)
	}

	getWidth () {
		let w, d, e, g;
		w = window;
		d = document;
		e = d.documentElement;
		g = d.getElementsByTagName("body")[0];

		return w.innerWidth || e.clientWidth || g.clientWidth;
	}

}

export function dynamicSort(property) {
	let sortOrder = 1

	if (property[0] === "-") {
		sortOrder = -1;
		property = property.substr(1);
	}
	return (a, b) => {
		var result =
			a[property] < b[property] ? -1 : a[property] > b[property] ? 1 : 0;
		return result * sortOrder;
	}
}
