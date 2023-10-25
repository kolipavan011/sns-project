import{r as b,a as F,c as H,d as V,e as q}from"./selector-engine-55adf8d4.js";var z={exports:{}};/*!
  * Bootstrap collapse.js v5.3.2 (https://getbootstrap.com/)
  * Copyright 2011-2023 The Bootstrap Authors (https://github.com/twbs/bootstrap/graphs/contributors)
  * Licensed under MIT (https://github.com/twbs/bootstrap/blob/main/LICENSE)
  */(function(A,R){(function(p,n){A.exports=n(b(),F(),H(),V())})(q,function(p,n,i,d){const E="collapse",h=".bs.collapse",C=".data-api",L=`show${h}`,T=`shown${h}`,S=`hide${h}`,D=`hidden${h}`,N=`click${h}${C}`,m="show",r="collapse",_="collapsing",w="collapsed",y=`:scope .${r} .${r}`,I="collapse-horizontal",O="width",$="height",v=".collapse.show, .collapse.collapsing",f='[data-bs-toggle="collapse"]',M={parent:null,toggle:!0},P={parent:"(null|element)",toggle:"boolean"};class a extends p{constructor(t,s){super(t,s),this._isTransitioning=!1,this._triggerArray=[];const e=i.find(f);for(const l of e){const c=i.getSelectorFromElement(l),u=i.find(c).filter(o=>o===this._element);c!==null&&u.length&&this._triggerArray.push(l)}this._initializeChildren(),this._config.parent||this._addAriaAndCollapsedClass(this._triggerArray,this._isShown()),this._config.toggle&&this.toggle()}static get Default(){return M}static get DefaultType(){return P}static get NAME(){return E}toggle(){this._isShown()?this.hide():this.show()}show(){if(this._isTransitioning||this._isShown())return;let t=[];if(this._config.parent&&(t=this._getFirstLevelChildren(v).filter(o=>o!==this._element).map(o=>a.getOrCreateInstance(o,{toggle:!1}))),t.length&&t[0]._isTransitioning||n.trigger(this._element,L).defaultPrevented)return;for(const o of t)o.hide();const e=this._getDimension();this._element.classList.remove(r),this._element.classList.add(_),this._element.style[e]=0,this._addAriaAndCollapsedClass(this._triggerArray,!0),this._isTransitioning=!0;const l=()=>{this._isTransitioning=!1,this._element.classList.remove(_),this._element.classList.add(r,m),this._element.style[e]="",n.trigger(this._element,T)},u=`scroll${e[0].toUpperCase()+e.slice(1)}`;this._queueCallback(l,this._element,!0),this._element.style[e]=`${this._element[u]}px`}hide(){if(this._isTransitioning||!this._isShown()||n.trigger(this._element,S).defaultPrevented)return;const s=this._getDimension();this._element.style[s]=`${this._element.getBoundingClientRect()[s]}px`,d.reflow(this._element),this._element.classList.add(_),this._element.classList.remove(r,m);for(const l of this._triggerArray){const c=i.getElementFromSelector(l);c&&!this._isShown(c)&&this._addAriaAndCollapsedClass([l],!1)}this._isTransitioning=!0;const e=()=>{this._isTransitioning=!1,this._element.classList.remove(_),this._element.classList.add(r),n.trigger(this._element,D)};this._element.style[s]="",this._queueCallback(e,this._element,!0)}_isShown(t=this._element){return t.classList.contains(m)}_configAfterMerge(t){return t.toggle=!!t.toggle,t.parent=d.getElement(t.parent),t}_getDimension(){return this._element.classList.contains(I)?O:$}_initializeChildren(){if(!this._config.parent)return;const t=this._getFirstLevelChildren(f);for(const s of t){const e=i.getElementFromSelector(s);e&&this._addAriaAndCollapsedClass([s],this._isShown(e))}}_getFirstLevelChildren(t){const s=i.find(y,this._config.parent);return i.find(t,this._config.parent).filter(e=>!s.includes(e))}_addAriaAndCollapsedClass(t,s){if(t.length)for(const e of t)e.classList.toggle(w,!s),e.setAttribute("aria-expanded",s)}static jQueryInterface(t){const s={};return typeof t=="string"&&/show|hide/.test(t)&&(s.toggle=!1),this.each(function(){const e=a.getOrCreateInstance(this,s);if(typeof t=="string"){if(typeof e[t]>"u")throw new TypeError(`No method named "${t}"`);e[t]()}})}}return n.on(document,N,f,function(g){(g.target.tagName==="A"||g.delegateTarget&&g.delegateTarget.tagName==="A")&&g.preventDefault();for(const t of i.getMultipleElementsFromSelector(this))a.getOrCreateInstance(t,{toggle:!1}).toggle()}),d.defineJQueryPlugin(a),a})})(z);
