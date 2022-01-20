/*! jQuery v3.6.0 | (c) OpenJS Foundation and other contributors | jquery.org/license */
!function(e,t){"use strict";"object"==typeof module&&"object"==typeof module.exports?module.exports=e.document?t(e,!0):function(e){if(!e.document)throw new Error("jQuery requires a window with a document");return t(e)}:t(e)}("undefined"!=typeof window?window:this,function(C,e){"use strict";var t=[],r=Object.getPrototypeOf,s=t.slice,g=t.flat?function(e){return t.flat.call(e)}:function(e){return t.concat.apply([],e)},u=t.push,i=t.indexOf,n={},o=n.toString,v=n.hasOwnProperty,a=v.toString,l=a.call(Object),y={},m=function(e){return"function"==typeof e&&"number"!=typeof e.nodeType&&"function"!=typeof e.item},x=function(e){return null!=e&&e===e.window},E=C.document,c={type:!0,src:!0,nonce:!0,noModule:!0};function b(e,t,n){var r,i,o=(n=n||E).createElement("script");if(o.text=e,t)for(r in c)(i=t[r]||t.getAttribute&&t.getAttribute(r))&&o.setAttribute(r,i);n.head.appendChild(o).parentNode.removeChild(o)}function w(e){return null==e?e+"":"object"==typeof e||"function"==typeof e?n[o.call(e)]||"object":typeof e}var f="3.6.0",S=function(e,t){return new S.fn.init(e,t)};function p(e){var t=!!e&&"length"in e&&e.length,n=w(e);return!m(e)&&!x(e)&&("array"===n||0===t||"number"==typeof t&&0<t&&t-1 in e)}S.fn=S.prototype={jquery:f,constructor:S,length:0,toArray:function(){return s.call(this)},get:function(e){return null==e?s.call(this):e<0?this[e+this.length]:this[e]},pushStack:function(e){var t=S.merge(this.constructor(),e);return t.prevObject=this,t},each:function(e){return S.each(this,e)},map:function(n){return this.pushStack(S.map(this,function(e,t){return n.call(e,t,e)}))},slice:function(){return this.pushStack(s.apply(this,arguments))},first:function(){return this.eq(0)},last:function(){return this.eq(-1)},even:function(){return this.pushStack(S.grep(this,function(e,t){return(t+1)%2}))},odd:function(){return this.pushStack(S.grep(this,function(e,t){return t%2}))},eq:function(e){var t=this.length,n=+e+(e<0?t:0);return this.pushStack(0<=n&&n<t?[this[n]]:[])},end:function(){return this.prevObject||this.constructor()},push:u,sort:t.sort,splice:t.splice},S.extend=S.fn.extend=function(){var e,t,n,r,i,o,a=arguments[0]||{},s=1,u=arguments.length,l=!1;for("boolean"==typeof a&&(l=a,a=arguments[s]||{},s++),"object"==typeof a||m(a)||(a={}),s===u&&(a=this,s--);s<u;s++)if(null!=(e=arguments[s]))for(t in e)r=e[t],"__proto__"!==t&&a!==r&&(l&&r&&(S.isPlainObject(r)||(i=Array.isArray(r)))?(n=a[t],o=i&&!Array.isArray(n)?[]:i||S.isPlainObject(n)?n:{},i=!1,a[t]=S.extend(l,o,r)):void 0!==r&&(a[t]=r));return a},S.extend({expando:"jQuery"+(f+Math.random()).replace(/\D/g,""),isReady:!0,error:function(e){throw new Error(e)},noop:function(){},isPlainObject:function(e){var t,n;return!(!e||"[object Object]"!==o.call(e))&&(!(t=r(e))||"function"==typeof(n=v.call(t,"constructor")&&t.constructor)&&a.call(n)===l)},isEmptyObject:function(e){var t;for(t in e)return!1;return!0},globalEval:function(e,t,n){b(e,{nonce:t&&t.nonce},n)},each:function(e,t){var n,r=0;if(p(e)){for(n=e.length;r<n;r++)if(!1===t.call(e[r],r,e[r]))break}else for(r in e)if(!1===t.call(e[r],r,e[r]))break;return e},makeArray:function(e,t){var n=t||[];return null!=e&&(p(Object(e))?S.merge(n,"string"==typeof e?[e]:e):u.call(n,e)),n},inArray:function(e,t,n){return null==t?-1:i.call(t,e,n)},merge:function(e,t){for(var n=+t.length,r=0,i=e.length;r<n;r++)e[i++]=t[r];return e.length=i,e},grep:function(e,t,n){for(var r=[],i=0,o=e.length,a=!n;i<o;i++)!t(e[i],i)!==a&&r.push(e[i]);return r},map:function(e,t,n){var r,i,o=0,a=[];if(p(e))for(r=e.length;o<r;o++)null!=(i=t(e[o],o,n))&&a.push(i);else for(o in e)null!=(i=t(e[o],o,n))&&a.push(i);return g(a)},guid:1,support:y}),"function"==typeof Symbol&&(S.fn[Symbol.iterator]=t[Symbol.iterator]),S.each("Boolean Number String Function Array Date RegExp Object Error Symbol".split(" "),function(e,t){n["[object "+t+"]"]=t.toLowerCase()});var d=function(n){var e,d,b,o,i,h,f,g,w,u,l,T,C,a,E,v,s,c,y,S="sizzle"+1*new Date,p=n.document,k=0,r=0,m=ue(),x=ue(),A=ue(),N=ue(),j=function(e,t){return e===t&&(l=!0),0},D={}.hasOwnProperty,t=[],q=t.pop,L=t.push,H=t.push,O=t.slice,P=function(e,t){for(var n=0,r=e.length;n<r;n++)if(e[n]===t)return n;return-1},R="checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped",M="[\\x20\\t\\r\\n\\f]",I="(?:\\\\[\\da-fA-F]{1,6}"+M+"?|\\\\[^\\r\\n\\f]|[\\w-]|[^\0-\\x7f])+",W="\\["+M+"*("+I+")(?:"+M+"*([*^$|!~]?=)"+M+"*(?:'((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\"|("+I+"))|)"+M+"*\\]",F=":("+I+")(?:\\((('((?:\\\\.|[^\\\\'])*)'|\"((?:\\\\.|[^\\\\\"])*)\")|((?:\\\\.|[^\\\\()[\\]]|"+W+")*)|.*)\\)|)",B=new RegExp(M+"+","g"),$=new RegExp("^"+M+"+|((?:^|[^\\\\])(?:\\\\.)*)"+M+"+$","g"),_=new RegExp("^"+M+"*,"+M+"*"),z=new RegExp("^"+M+"*([>+~]|"+M+")"+M+"*"),U=new RegExp(M+"|>"),X=new RegExp(F),V=new RegExp("^"+I+"$"),G={ID:new RegExp("^#("+I+")"),CLASS:new RegExp("^\\.("+I+")"),TAG:new RegExp("^("+I+"|[*])"),ATTR:new RegExp("^"+W),PSEUDO:new RegExp("^"+F),CHILD:new RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\("+M+"*(even|odd|(([+-]|)(\\d*)n|)"+M+"*(?:([+-]|)"+M+"*(\\d+)|))"+M+"*\\)|)","i"),bool:new RegExp("^(?:"+R+")$","i"),needsContext:new RegExp("^"+M+"*[>+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\("+M+"*((?:-\\d)?\\d*)"+M+"*\\)|)(?=[^-]|$)","i")},Y=/HTML$/i,Q=/^(?:input|select|textarea|button)$/i,J=/^h\d$/i,K=/^[^{]+\{\s*\[native \w/,Z=/^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/,ee=/[+~]/,te=new RegExp("\\\\[\\da-fA-F]{1,6}"+M+"?|\\\\([^\\r\\n\\f])","g"),ne=function(e,t){var n="0x"+e.slice(1)-65536;return t||(n<0?String.fromCharCode(n+65536):String.fromCharCode(n>>10|55296,1023&n|56320))},re=/([\0-\x1f\x7f]|^-?\d)|^-$|[^\0-\x1f\x7f-\uFFFF\w-]/g,ie=function(e,t){return t?"\0"===e?"\ufffd":e.slice(0,-1)+"\\"+e.charCodeAt(e.length-1).toString(16)+" ":"\\"+e},oe=function(){T()},ae=be(function(e){return!0===e.disabled&&"fieldset"===e.nodeName.toLowerCase()},{dir:"parentNode",next:"legend"});try{H.apply(t=O.call(p.childNodes),p.childNodes),t[p.childNodes.length].nodeType}catch(e){H={apply:t.length?function(e,t){L.apply(e,O.call(t))}:function(e,t){var n=e.length,r=0;while(e[n++]=t[r++]);e.length=n-1}}}function se(t,e,n,r){var i,o,a,s,u,l,c,f=e&&e.ownerDocument,p=e?e.nodeType:9;if(n=n||[],"string"!=typeof t||!t||1!==p&&9!==p&&11!==p)return n;if(!r&&(T(e),e=e||C,E)){if(11!==p&&(u=Z.exec(t)))if(i=u[1]){if(9===p){if(!(a=e.getElementById(i)))return n;if(a.id===i)return n.push(a),n}else if(f&&(a=f.getElementById(i))&&y(e,a)&&a.id===i)return n.push(a),n}else{if(u[2])return H.apply(n,e.getElementsByTagName(t)),n;if((i=u[3])&&d.getElementsByClassName&&e.getElementsByClassName)return H.apply(n,e.getElementsByClassName(i)),n}if(d.qsa&&!N[t+" "]&&(!v||!v.test(t))&&(1!==p||"object"!==e.nodeName.toLowerCase())){if(c=t,f=e,1===p&&(U.test(t)||z.test(t))){(f=ee.test(t)&&ye(e.parentNode)||e)===e&&d.scope||((s=e.getAttribute("id"))?s=s.replace(re,ie):e.setAttribute("id",s=S)),o=(l=h(t)).length;while(o--)l[o]=(s?"#"+s:":scope")+" "+xe(l[o]);c=l.join(",")}try{return H.apply(n,f.querySelectorAll(c)),n}catch(e){N(t,!0)}finally{s===S&&e.removeAttribute("id")}}}return g(t.replace($,"$1"),e,n,r)}function ue(){var r=[];return function e(t,n){return r.push(t+" ")>b.cacheLength&&delete e[r.shift()],e[t+" "]=n}}function le(e){return e[S]=!0,e}function ce(e){var t=C.createElement("fieldset");try{return!!e(t)}catch(e){return!1}finally{t.parentNode&&t.parentNode.removeChild(t),t=null}}function fe(e,t){var n=e.split("|"),r=n.length;while(r--)b.attrHandle[n[r]]=t}function pe(e,t){var n=t&&e,r=n&&1===e.nodeType&&1===t.nodeType&&e.sourceIndex-t.sourceIndex;if(r)return r;if(n)while(n=n.nextSibling)if(n===t)return-1;return e?1:-1}function de(t){return function(e){return"input"===e.nodeName.toLowerCase()&&e.type===t}}function he(n){return function(e){var t=e.nodeName.toLowerCase();return("input"===t||"button"===t)&&e.type===n}}function ge(t){return function(e){return"form"in e?e.parentNode&&!1===e.disabled?"label"in e?"label"in e.parentNode?e.parentNode.disabled===t:e.disabled===t:e.isDisabled===t||e.isDisabled!==!t&&ae(e)===t:e.disabled===t:"label"in e&&e.disabled===t}}function ve(a){return le(function(o){return o=+o,le(function(e,t){var n,r=a([],e.length,o),i=r.length;while(i--)e[n=r[i]]&&(e[n]=!(t[n]=e[n]))})})}function ye(e){return e&&"undefined"!=typeof e.getElementsByTagName&&e}for(e in d=se.support={},i=se.isXML=function(e){var t=e&&e.namespaceURI,n=e&&(e.ownerDocument||e).documentElement;return!Y.test(t||n&&n.nodeName||"HTML")},T=se.setDocument=function(e){var t,n,r=e?e.ownerDocument||e:p;return r!=C&&9===r.nodeType&&r.documentElement&&(a=(C=r).documentElement,E=!i(C),p!=C&&(n=C.defaultView)&&n.top!==n&&(n.addEventListener?n.addEventListener("unload",oe,!1):n.attachEvent&&n.attachEvent("onunload",oe)),d.scope=ce(function(e){return a.appendChild(e).appendChild(C.createElement("div")),"undefined"!=typeof e.querySelectorAll&&!e.querySelectorAll(":scope fieldset div").length}),d.attributes=ce(function(e){return e.className="i",!e.getAttribute("className")}),d.getElementsByTagName=ce(function(e){return e.appendChild(C.createComment("")),!e.getElementsByTagName("*").length}),d.getElementsByClassName=K.test(C.getElementsByClassName),d.getById=ce(function(e){return a.appendChild(e).id=S,!C.getElementsByName||!C.getElementsByName(S).length}),d.getById?(b.filter.ID=function(e){var t=e.replace(te,ne);return function(e){return e.getAttribute("id")===t}},b.find.ID=function(e,t){if("undefined"!=typeof t.getElementById&&E){var n=t.getElementById(e);return n?[n]:[]}}):(b.filter.ID=function(e){var n=e.replace(te,ne);return function(e){var t="undefined"!=typeof e.getAttributeNode&&e.getAttributeNode("id");return t&&t.value===n}},b.find.ID=function(e,t){if("undefined"!=typeof t.getElementById&&E){var n,r,i,o=t.getElementById(e);if(o){if((n=o.getAttributeNode("id"))&&n.value===e)return[o];i=t.getElementsByName(e),r=0;while(o=i[r++])if((n=o.getAttributeNode("id"))&&n.value===e)return[o]}return[]}}),b.find.TAG=d.getElementsByTagName?function(e,t){return"undefined"!=typeof t.getElementsByTagName?t.getElementsByTagName(e):d.qsa?t.querySelectorAll(e):void 0}:function(e,t){var n,r=[],i=0,o=t.getElementsByTagName(e);if("*"===e){while(n=o[i++])1===n.nodeType&&r.push(n);return r}return o},b.find.CLASS=d.getElementsByClassName&&function(e,t){if("undefined"!=typeof t.getElementsByClassName&&E)return t.getElementsByClassName(e)},s=[],v=[],(d.qsa=K.test(C.querySelectorAll))&&(ce(function(e){var t;a.appendChild(e).innerHTML="<a id='"+S+"'></a><select id='"+S+"-\r\\' msallowcapture=''><option selected=''></option></select>",e.querySelectorAll("[msallowcapture^='']").length&&v.push("[*^$]="+M+"*(?:''|\"\")"),e.querySelectorAll("[selected]").length||v.push("\\["+M+"*(?:value|"+R+")"),e.querySelectorAll("[id~="+S+"-]").length||v.push("~="),(t=C.createElement("input")).setAttribute("name",""),e.appendChild(t),e.querySelectorAll("[name='']").length||v.push("\\["+M+"*name"+M+"*="+M+"*(?:''|\"\")"),e.querySelectorAll(":checked").length||v.push(":checked"),e.querySelectorAll("a#"+S+"+*").length||v.push(".#.+[+~]"),e.querySelectorAll("\\\f"),v.push("[\\r\\n\\f]")}),ce(function(e){e.innerHTML="<a href='' disabled='disabled'></a><select disabled='disabled'><option/></select>";var t=C.createElement("input");t.setAttribute("type","hidden"),e.appendChild(t).setAttribute("name","D"),e.querySelectorAll("[name=d]").length&&v.push("name"+M+"*[*^$|!~]?="),2!==e.querySelectorAll(":enabled").length&&v.push(":enabled",":disabled"),a.appendChild(e).disabled=!0,2!==e.querySelectorAll(":disabled").length&&v.push(":enabled",":disabled"),e.querySelectorAll("*,:x"),v.push(",.*:")})),(d.matchesSelector=K.test(c=a.matches||a.webkitMatchesSelector||a.mozMatchesSelector||a.oMatchesSelector||a.msMatchesSelector))&&ce(function(e){d.disconnectedMatch=c.call(e,"*"),c.call(e,"[s!='']:x"),s.push("!=",F)}),v=v.length&&new RegExp(v.join("|")),s=s.length&&new RegExp(s.join("|")),t=K.test(a.compareDocumentPosition),y=t||K.test(a.contains)?function(e,t){var n=9===e.nodeType?e.documentElement:e,r=t&&t.parentNode;return e===r||!(!r||1!==r.nodeType||!(n.contains?n.contains(r):e.compareDocumentPosition&&16&e.compareDocumentPosition(r)))}:function(e,t){if(t)while(t=t.parentNode)if(t===e)return!0;return!1},j=t?function(e,t){if(e===t)return l=!0,0;var n=!e.compareDocumentPosition-!t.compareDocumentPosition;return n||(1&(n=(e.ownerDocument||e)==(t.ownerDocument||t)?e.compareDocumentPosition(t):1)||!d.sortDetached&&t.compareDocumentPosition(e)===n?e==C||e.ownerDocument==p&&y(p,e)?-1:t==C||t.ownerDocument==p&&y(p,t)?1:u?P(u,e)-P(u,t):0:4&n?-1:1)}:function(e,t){if(e===t)return l=!0,0;var n,r=0,i=e.parentNode,o=t.parentNode,a=[e],s=[t];if(!i||!o)return e==C?-1:t==C?1:i?-1:o?1:u?P(u,e)-P(u,t):0;if(i===o)return pe(e,t);n=e;while(n=n.parentNode)a.unshift(n);n=t;while(n=n.parentNode)s.unshift(n);while(a[r]===s[r])r++;return r?pe(a[r],s[r]):a[r]==p?-1:s[r]==p?1:0}),C},se.matches=function(e,t){return se(e,null,null,t)},se.matchesSelector=function(e,t){if(T(e),d.matchesSelector&&E&&!N[t+" "]&&(!s||!s.test(t))&&(!v||!v.test(t)))try{var n=c.call(e,t);if(n||d.disconnectedMatch||e.document&&11!==e.document.nodeType)return n}catch(e){N(t,!0)}return 0<se(t,C,null,[e]).length},se.contains=function(e,t){return(e.ownerDocument||e)!=C&&T(e),y(e,t)},se.attr=function(e,t){(e.ownerDocument||e)!=C&&T(e);var n=b.attrHandle[t.toLowerCase()],r=n&&D.call(b.attrHandle,t.toLowerCase())?n(e,t,!E):void 0;return void 0!==r?r:d.attributes||!E?e.getAttribute(t):(r=e.getAttributeNode(t))&&r.specified?r.value:null},se.escape=function(e){return(e+"").replace(re,ie)},se.error=function(e){throw new Error("Syntax error, unrecognized expression: "+e)},se.uniqueSort=function(e){var t,n=[],r=0,i=0;if(l=!d.detectDuplicates,u=!d.sortStable&&e.slice(0),e.sort(j),l){while(t=e[i++])t===e[i]&&(r=n.push(i));while(r--)e.splice(n[r],1)}return u=null,e},o=se.getText=function(e){var t,n="",r=0,i=e.nodeType;if(i){if(1===i||9===i||11===i){if("string"==typeof e.textContent)return e.textContent;for(e=e.firstChild;e;e=e.nextSibling)n+=o(e)}else if(3===i||4===i)return e.nodeValue}else while(t=e[r++])n+=o(t);return n},(b=se.selectors={cacheLength:50,createPseudo:le,match:G,attrHandle:{},find:{},relative:{">":{dir:"parentNode",first:!0}," ":{dir:"parentNode"},"+":{dir:"previousSibling",first:!0},"~":{dir:"previousSibling"}},preFilter:{ATTR:function(e){return e[1]=e[1].replace(te,ne),e[3]=(e[3]||e[4]||e[5]||"").replace(te,ne),"~="===e[2]&&(e[3]=" "+e[3]+" "),e.slice(0,4)},CHILD:function(e){return e[1]=e[1].toLowerCase(),"nth"===e[1].slice(0,3)?(e[3]||se.error(e[0]),e[4]=+(e[4]?e[5]+(e[6]||1):2*("even"===e[3]||"odd"===e[3])),e[5]=+(e[7]+e[8]||"odd"===e[3])):e[3]&&se.error(e[0]),e},PSEUDO:function(e){var t,n=!e[6]&&e[2];return G.CHILD.test(e[0])?null:(e[3]?e[2]=e[4]||e[5]||"":n&&X.test(n)&&(t=h(n,!0))&&(t=n.indexOf(")",n.length-t)-n.length)&&(e[0]=e[0].slice(0,t),e[2]=n.slice(0,t)),e.slice(0,3))}},filter:{TAG:function(e){var t=e.replace(te,ne).toLowerCase();return"*"===e?function(){return!0}:function(e){return e.nodeName&&e.nodeName.toLowerCase()===t}},CLASS:function(e){var t=m[e+" "];return t||(t=new RegExp("(^|"+M+")"+e+"("+M+"|$)"))&&m(e,function(e){return t.test("string"==typeof e.className&&e.className||"undefined"!=typeof e.getAttribute&&e.getAttribute("class")||"")})},ATTR:function(n,r,i){return function(e){var t=se.attr(e,n);return null==t?"!="===r:!r||(t+="","="===r?t===i:"!="===r?t!==i:"^="===r?i&&0===t.indexOf(i):"*="===r?i&&-1<t.indexOf(i):"$="===r?i&&t.slice(-i.length)===i:"~="===r?-1<(" "+t.replace(B," ")+" ").indexOf(i):"|="===r&&(t===i||t.slice(0,i.length+1)===i+"-"))}},CHILD:function(h,e,t,g,v){var y="nth"!==h.slice(0,3),m="last"!==h.slice(-4),x="of-type"===e;return 1===g&&0===v?function(e){return!!e.parentNode}:function(e,t,n){var r,i,o,a,s,u,l=y!==m?"nextSibling":"previousSibling",c=e.parentNode,f=x&&e.nodeName.toLowerCase(),p=!n&&!x,d=!1;if(c){if(y){while(l){a=e;while(a=a[l])if(x?a.nodeName.toLowerCase()===f:1===a.nodeType)return!1;u=l="only"===h&&!u&&"nextSibling"}return!0}if(u=[m?c.firstChild:c.lastChild],m&&p){d=(s=(r=(i=(o=(a=c)[S]||(a[S]={}))[a.uniqueID]||(o[a.uniqueID]={}))[h]||[])[0]===k&&r[1])&&r[2],a=s&&c.childNodes[s];while(a=++s&&a&&a[l]||(d=s=0)||u.pop())if(1===a.nodeType&&++d&&a===e){i[h]=[k,s,d];break}}else if(p&&(d=s=(r=(i=(o=(a=e)[S]||(a[S]={}))[a.uniqueID]||(o[a.uniqueID]={}))[h]||[])[0]===k&&r[1]),!1===d)while(a=++s&&a&&a[l]||(d=s=0)||u.pop())if((x?a.nodeName.toLowerCase()===f:1===a.nodeType)&&++d&&(p&&((i=(o=a[S]||(a[S]={}))[a.uniqueID]||(o[a.uniqueID]={}))[h]=[k,d]),a===e))break;return(d-=v)===g||d%g==0&&0<=d/g}}},PSEUDO:function(e,o){var t,a=b.pseudos[e]||b.setFilters[e.toLowerCase()]||se.error("unsupported pseudo: "+e);return a[S]?a(o):1<a.length?(t=[e,e,"",o],b.setFilters.hasOwnProperty(e.toLowerCase())?le(function(e,t){var n,r=a(e,o),i=r.length;while(i--)e[n=P(e,r[i])]=!(t[n]=r[i])}):function(e){return a(e,0,t)}):a}},pseudos:{not:le(function(e){var r=[],i=[],s=f(e.replace($,"$1"));return s[S]?le(function(e,t,n,r){var i,o=s(e,null,r,[]),a=e.length;while(a--)(i=o[a])&&(e[a]=!(t[a]=i))}):function(e,t,n){return r[0]=e,s(r,null,n,i),r[0]=null,!i.pop()}}),has:le(function(t){return function(e){return 0<se(t,e).length}}),contains:le(function(t){return t=t.replace(te,ne),function(e){return-1<(e.textContent||o(e)).indexOf(t)}}),lang:le(function(n){return V.test(n||"")||se.error("unsupported lang: "+n),n=n.replace(te,ne).toLowerCase(),function(e){var t;do{if(t=E?e.lang:e.getAttribute("xml:lang")||e.getAttribute("lang"))return(t=t.toLowerCase())===n||0===t.indexOf(n+"-")}while((e=e.parentNode)&&1===e.nodeType);return!1}}),target:function(e){var t=n.location&&n.location.hash;return t&&t.slice(1)===e.id},root:function(e){return e===a},focus:function(e){return e===C.activeElement&&(!C.hasFocus||C.hasFocus())&&!!(e.type||e.href||~e.tabIndex)},enabled:ge(!1),disabled:ge(!0),checked:function(e){var t=e.nodeName.toLowerCase();return"input"===t&&!!e.checked||"option"===t&&!!e.selected},selected:function(e){return e.parentNode&&e.parentNode.selectedIndex,!0===e.selected},empty:function(e){for(e=e.firstChild;e;e=e.nextSibling)if(e.nodeType<6)return!1;return!0},parent:function(e){return!b.pseudos.empty(e)},header:function(e){return J.test(e.nodeName)},input:function(e){return Q.test(e.nodeName)},button:function(e){var t=e.nodeName.toLowerCase();return"input"===t&&"button"===e.type||"button"===t},text:function(e){var t;return"input"===e.nodeName.toLowerCase()&&"text"===e.type&&(null==(t=e.getAttribute("type"))||"text"===t.toLowerCase())},first:ve(function(){return[0]}),last:ve(function(e,t){return[t-1]}),eq:ve(function(e,t,n){return[n<0?n+t:n]}),even:ve(function(e,t){for(var n=0;n<t;n+=2)e.push(n);return e}),odd:ve(function(e,t){for(var n=1;n<t;n+=2)e.push(n);return e}),lt:ve(function(e,t,n){for(var r=n<0?n+t:t<n?t:n;0<=--r;)e.push(r);return e}),gt:ve(function(e,t,n){for(var r=n<0?n+t:n;++r<t;)e.push(r);return e})}}).pseudos.nth=b.pseudos.eq,{radio:!0,checkbox:!0,file:!0,password:!0,image:!0})b.pseudos[e]=de(e);for(e in{submit:!0,reset:!0})b.pseudos[e]=he(e);function me(){}function xe(e){for(var t=0,n=e.length,r="";t<n;t++)r+=e[t].value;return r}function be(s,e,t){var u=e.dir,l=e.next,c=l||u,f=t&&"parentNode"===c,p=r++;return e.first?function(e,t,n){while(e=e[u])if(1===e.nodeType||f)return s(e,t,n);return!1}:function(e,t,n){var r,i,o,a=[k,p];if(n){while(e=e[u])if((1===e.nodeType||f)&&s(e,t,n))return!0}else while(e=e[u])if(1===e.nodeType||f)if(i=(o=e[S]||(e[S]={}))[e.uniqueID]||(o[e.uniqueID]={}),l&&l===e.nodeName.toLowerCase())e=e[u]||e;else{if((r=i[c])&&r[0]===k&&r[1]===p)return a[2]=r[2];if((i[c]=a)[2]=s(e,t,n))return!0}return!1}}function we(i){return 1<i.length?function(e,t,n){var r=i.length;while(r--)if(!i[r](e,t,n))return!1;return!0}:i[0]}function Te(e,t,n,r,i){for(var o,a=[],s=0,u=e.length,l=null!=t;s<u;s++)(o=e[s])&&(n&&!n(o,r,i)||(a.push(o),l&&t.push(s)));return a}function Ce(d,h,g,v,y,e){return v&&!v[S]&&(v=Ce(v)),y&&!y[S]&&(y=Ce(y,e)),le(function(e,t,n,r){var i,o,a,s=[],u=[],l=t.length,c=e||function(e,t,n){for(var r=0,i=t.length;r<i;r++)se(e,t[r],n);return n}(h||"*",n.nodeType?[n]:n,[]),f=!d||!e&&h?c:Te(c,s,d,n,r),p=g?y||(e?d:l||v)?[]:t:f;if(g&&g(f,p,n,r),v){i=Te(p,u),v(i,[],n,r),o=i.length;while(o--)(a=i[o])&&(p[u[o]]=!(f[u[o]]=a))}if(e){if(y||d){if(y){i=[],o=p.length;while(o--)(a=p[o])&&i.push(f[o]=a);y(null,p=[],i,r)}o=p.length;while(o--)(a=p[o])&&-1<(i=y?P(e,a):s[o])&&(e[i]=!(t[i]=a))}}else p=Te(p===t?p.splice(l,p.length):p),y?y(null,t,p,r):H.apply(t,p)})}function Ee(e){for(var i,t,n,r=e.length,o=b.relative[e[0].type],a=o||b.relative[" "],s=o?1:0,u=be(function(e){return e===i},a,!0),l=be(function(e){return-1<P(i,e)},a,!0),c=[function(e,t,n){var r=!o&&(n||t!==w)||((i=t).nodeType?u(e,t,n):l(e,t,n));return i=null,r}];s<r;s++)if(t=b.relative[e[s].type])c=[be(we(c),t)];else{if((t=b.filter[e[s].type].apply(null,e[s].matches))[S]){for(n=++s;n<r;n++)if(b.relative[e[n].type])break;return Ce(1<s&&we(c),1<s&&xe(e.slice(0,s-1).concat({value:" "===e[s-2].type?"*":""})).replace($,"$1"),t,s<n&&Ee(e.slice(s,n)),n<r&&Ee(e=e.slice(n)),n<r&&xe(e))}c.push(t)}return we(c)}return me.prototype=b.filters=b.pseudos,b.setFilters=new me,h=se.tokenize=function(e,t){var n,r,i,o,a,s,u,l=x[e+" "];if(l)return t?0:l.slice(0);a=e,s=[],u=b.preFilter;while(a){for(o in n&&!(r=_.exec(a))||(r&&(a=a.slice(r[0].length)||a),s.push(i=[])),n=!1,(r=z.exec(a))&&(n=r.shift(),i.push({value:n,type:r[0].replace($," ")}),a=a.slice(n.length)),b.filter)!(r=G[o].exec(a))||u[o]&&!(r=u[o](r))||(n=r.shift(),i.push({value:n,type:o,matches:r}),a=a.slice(n.length));if(!n)break}return t?a.length:a?se.error(e):x(e,s).slice(0)},f=se.compile=function(e,t){var n,v,y,m,x,r,i=[],o=[],a=A[e+" "];if(!a){t||(t=h(e)),n=t.length;while(n--)(a=Ee(t[n]))[S]?i.push(a):o.push(a);(a=A(e,(v=o,m=0<(y=i).length,x=0<v.length,r=function(e,t,n,r,i){var o,a,s,u=0,l="0",c=e&&[],f=[],p=w,d=e||x&&b.find.TAG("*",i),h=k+=null==p?1:Math.random()||.1,g=d.length;for(i&&(w=t==C||t||i);l!==g&&null!=(o=d[l]);l++){if(x&&o){a=0,t||o.ownerDocument==C||(T(o),n=!E);while(s=v[a++])if(s(o,t||C,n)){r.push(o);break}i&&(k=h)}m&&((o=!s&&o)&&u--,e&&c.push(o))}if(u+=l,m&&l!==u){a=0;while(s=y[a++])s(c,f,t,n);if(e){if(0<u)while(l--)c[l]||f[l]||(f[l]=q.call(r));f=Te(f)}H.apply(r,f),i&&!e&&0<f.length&&1<u+y.length&&se.uniqueSort(r)}return i&&(k=h,w=p),c},m?le(r):r))).selector=e}return a},g=se.select=function(e,t,n,r){var i,o,a,s,u,l="function"==typeof e&&e,c=!r&&h(e=l.selector||e);if(n=n||[],1===c.length){if(2<(o=c[0]=c[0].slice(0)).length&&"ID"===(a=o[0]).type&&9===t.nodeType&&E&&b.relative[o[1].type]){if(!(t=(b.find.ID(a.matches[0].replace(te,ne),t)||[])[0]))return n;l&&(t=t.parentNode),e=e.slice(o.shift().value.length)}i=G.needsContext.test(e)?0:o.length;while(i--){if(a=o[i],b.relative[s=a.type])break;if((u=b.find[s])&&(r=u(a.matches[0].replace(te,ne),ee.test(o[0].type)&&ye(t.parentNode)||t))){if(o.splice(i,1),!(e=r.length&&xe(o)))return H.apply(n,r),n;break}}}return(l||f(e,c))(r,t,!E,n,!t||ee.test(e)&&ye(t.parentNode)||t),n},d.sortStable=S.split("").sort(j).join("")===S,d.detectDuplicates=!!l,T(),d.sortDetached=ce(function(e){return 1&e.compareDocumentPosition(C.createElement("fieldset"))}),ce(function(e){return e.innerHTML="<a href='#'></a>","#"===e.firstChild.getAttribute("href")})||fe("type|href|height|width",function(e,t,n){if(!n)return e.getAttribute(t,"type"===t.toLowerCase()?1:2)}),d.attributes&&ce(function(e){return e.innerHTML="<input/>",e.firstChild.setAttribute("value",""),""===e.firstChild.getAttribute("value")})||fe("value",function(e,t,n){if(!n&&"input"===e.nodeName.toLowerCase())return e.defaultValue}),ce(function(e){return null==e.getAttribute("disabled")})||fe(R,function(e,t,n){var r;if(!n)return!0===e[t]?t.toLowerCase():(r=e.getAttributeNode(t))&&r.specified?r.value:null}),se}(C);S.find=d,S.expr=d.selectors,S.expr[":"]=S.expr.pseudos,S.uniqueSort=S.unique=d.uniqueSort,S.text=d.getText,S.isXMLDoc=d.isXML,S.contains=d.contains,S.escapeSelector=d.escape;var h=function(e,t,n){var r=[],i=void 0!==n;while((e=e[t])&&9!==e.nodeType)if(1===e.nodeType){if(i&&S(e).is(n))break;r.push(e)}return r},T=function(e,t){for(var n=[];e;e=e.nextSibling)1===e.nodeType&&e!==t&&n.push(e);return n},k=S.expr.match.needsContext;function A(e,t){return e.nodeName&&e.nodeName.toLowerCase()===t.toLowerCase()}var N=/^<([a-z][^\/\0>:\x20\t\r\n\f]*)[\x20\t\r\n\f]*\/?>(?:<\/\1>|)$/i;function j(e,n,r){return m(n)?S.grep(e,function(e,t){return!!n.call(e,t,e)!==r}):n.nodeType?S.grep(e,function(e){return e===n!==r}):"string"!=typeof n?S.grep(e,function(e){return-1<i.call(n,e)!==r}):S.filter(n,e,r)}S.filter=function(e,t,n){var r=t[0];return n&&(e=":not("+e+")"),1===t.length&&1===r.nodeType?S.find.matchesSelector(r,e)?[r]:[]:S.find.matches(e,S.grep(t,function(e){return 1===e.nodeType}))},S.fn.extend({find:function(e){var t,n,r=this.length,i=this;if("string"!=typeof e)return this.pushStack(S(e).filter(function(){for(t=0;t<r;t++)if(S.contains(i[t],this))return!0}));for(n=this.pushStack([]),t=0;t<r;t++)S.find(e,i[t],n);return 1<r?S.uniqueSort(n):n},filter:function(e){return this.pushStack(j(this,e||[],!1))},not:function(e){return this.pushStack(j(this,e||[],!0))},is:function(e){return!!j(this,"string"==typeof e&&k.test(e)?S(e):e||[],!1).length}});var D,q=/^(?:\s*(<[\w\W]+>)[^>]*|#([\w-]+))$/;(S.fn.init=function(e,t,n){var r,i;if(!e)return this;if(n=n||D,"string"==typeof e){if(!(r="<"===e[0]&&">"===e[e.length-1]&&3<=e.length?[null,e,null]:q.exec(e))||!r[1]&&t)return!t||t.jquery?(t||n).find(e):this.constructor(t).find(e);if(r[1]){if(t=t instanceof S?t[0]:t,S.merge(this,S.parseHTML(r[1],t&&t.nodeType?t.ownerDocument||t:E,!0)),N.test(r[1])&&S.isPlainObject(t))for(r in t)m(this[r])?this[r](t[r]):this.attr(r,t[r]);return this}return(i=E.getElementById(r[2]))&&(this[0]=i,this.length=1),this}return e.nodeType?(this[0]=e,this.length=1,this):m(e)?void 0!==n.ready?n.ready(e):e(S):S.makeArray(e,this)}).prototype=S.fn,D=S(E);var L=/^(?:parents|prev(?:Until|All))/,H={children:!0,contents:!0,next:!0,prev:!0};function O(e,t){while((e=e[t])&&1!==e.nodeType);return e}S.fn.extend({has:function(e){var t=S(e,this),n=t.length;return this.filter(function(){for(var e=0;e<n;e++)if(S.contains(this,t[e]))return!0})},closest:function(e,t){var n,r=0,i=this.length,o=[],a="string"!=typeof e&&S(e);if(!k.test(e))for(;r<i;r++)for(n=this[r];n&&n!==t;n=n.parentNode)if(n.nodeType<11&&(a?-1<a.index(n):1===n.nodeType&&S.find.matchesSelector(n,e))){o.push(n);break}return this.pushStack(1<o.length?S.uniqueSort(o):o)},index:function(e){return e?"string"==typeof e?i.call(S(e),this[0]):i.call(this,e.jquery?e[0]:e):this[0]&&this[0].parentNode?this.first().prevAll().length:-1},add:function(e,t){return this.pushStack(S.uniqueSort(S.merge(this.get(),S(e,t))))},addBack:function(e){return this.add(null==e?this.prevObject:this.prevObject.filter(e))}}),S.each({parent:function(e){var t=e.parentNode;return t&&11!==t.nodeType?t:null},parents:function(e){return h(e,"parentNode")},parentsUntil:function(e,t,n){return h(e,"parentNode",n)},next:function(e){return O(e,"nextSibling")},prev:function(e){return O(e,"previousSibling")},nextAll:function(e){return h(e,"nextSibling")},prevAll:function(e){return h(e,"previousSibling")},nextUntil:function(e,t,n){return h(e,"nextSibling",n)},prevUntil:function(e,t,n){return h(e,"previousSibling",n)},siblings:function(e){return T((e.parentNode||{}).firstChild,e)},children:function(e){return T(e.firstChild)},contents:function(e){return null!=e.contentDocument&&r(e.contentDocument)?e.contentDocument:(A(e,"template")&&(e=e.content||e),S.merge([],e.childNodes))}},function(r,i){S.fn[r]=function(e,t){var n=S.map(this,i,e);return"Until"!==r.slice(-5)&&(t=e),t&&"string"==typeof t&&(n=S.filter(t,n)),1<this.length&&(H[r]||S.uniqueSort(n),L.test(r)&&n.reverse()),this.pushStack(n)}});var P=/[^\x20\t\r\n\f]+/g;function R(e){return e}function M(e){throw e}function I(e,t,n,r){var i;try{e&&m(i=e.promise)?i.call(e).done(t).fail(n):e&&m(i=e.then)?i.call(e,t,n):t.apply(void 0,[e].slice(r))}catch(e){n.apply(void 0,[e])}}S.Callbacks=function(r){var e,n;r="string"==typeof r?(e=r,n={},S.each(e.match(P)||[],function(e,t){n[t]=!0}),n):S.extend({},r);var i,t,o,a,s=[],u=[],l=-1,c=function(){for(a=a||r.once,o=i=!0;u.length;l=-1){t=u.shift();while(++l<s.length)!1===s[l].apply(t[0],t[1])&&r.stopOnFalse&&(l=s.length,t=!1)}r.memory||(t=!1),i=!1,a&&(s=t?[]:"")},f={add:function(){return s&&(t&&!i&&(l=s.length-1,u.push(t)),function n(e){S.each(e,function(e,t){m(t)?r.unique&&f.has(t)||s.push(t):t&&t.length&&"string"!==w(t)&&n(t)})}(arguments),t&&!i&&c()),this},remove:function(){return S.each(arguments,function(e,t){var n;while(-1<(n=S.inArray(t,s,n)))s.splice(n,1),n<=l&&l--}),this},has:function(e){return e?-1<S.inArray(e,s):0<s.length},empty:function(){return s&&(s=[]),this},disable:function(){return a=u=[],s=t="",this},disabled:function(){return!s},lock:function(){return a=u=[],t||i||(s=t=""),this},locked:function(){return!!a},fireWith:function(e,t){return a||(t=[e,(t=t||[]).slice?t.slice():t],u.push(t),i||c()),this},fire:function(){return f.fireWith(this,arguments),this},fired:function(){return!!o}};return f},S.extend({Deferred:function(e){var o=[["notify","progress",S.Callbacks("memory"),S.Callbacks("memory"),2],["resolve","done",S.Callbacks("once memory"),S.Callbacks("once memory"),0,"resolved"],["reject","fail",S.Callbacks("once memory"),S.Callbacks("once memory"),1,"rejected"]],i="pending",a={state:function(){return i},always:function(){return s.done(arguments).fail(arguments),this},"catch":function(e){return a.then(null,e)},pipe:function(){var i=arguments;return S.Deferred(function(r){S.each(o,function(e,t){var n=m(i[t[4]])&&i[t[4]];s[t[1]](function(){var e=n&&n.apply(this,arguments);e&&m(e.promise)?e.promise().progress(r.notify).done(r.resolve).fail(r.reject):r[t[0]+"With"](this,n?[e]:arguments)})}),i=null}).promise()},then:function(t,n,r){var u=0;function l(i,o,a,s){return function(){var n=this,r=arguments,e=function(){var e,t;if(!(i<u)){if((e=a.apply(n,r))===o.promise())throw new TypeError("Thenable self-resolution");t=e&&("object"==typeof e||"function"==typeof e)&&e.then,m(t)?s?t.call(e,l(u,o,R,s),l(u,o,M,s)):(u++,t.call(e,l(u,o,R,s),l(u,o,M,s),l(u,o,R,o.notifyWith))):(a!==R&&(n=void 0,r=[e]),(s||o.resolveWith)(n,r))}},t=s?e:function(){try{e()}catch(e){S.Deferred.exceptionHook&&S.Deferred.exceptionHook(e,t.stackTrace),u<=i+1&&(a!==M&&(n=void 0,r=[e]),o.rejectWith(n,r))}};i?t():(S.Deferred.getStackHook&&(t.stackTrace=S.Deferred.getStackHook()),C.setTimeout(t))}}return S.Deferred(function(e){o[0][3].add(l(0,e,m(r)?r:R,e.notifyWith)),o[1][3].add(l(0,e,m(t)?t:R)),o[2][3].add(l(0,e,m(n)?n:M))}).promise()},promise:function(e){return null!=e?S.extend(e,a):a}},s={};return S.each(o,function(e,t){var n=t[2],r=t[5];a[t[1]]=n.add,r&&n.add(function(){i=r},o[3-e][2].disable,o[3-e][3].disable,o[0][2].lock,o[0][3].lock),n.add(t[3].fire),s[t[0]]=function(){return s[t[0]+"With"](this===s?void 0:this,arguments),this},s[t[0]+"With"]=n.fireWith}),a.promise(s),e&&e.call(s,s),s},when:function(e){var n=arguments.length,t=n,r=Array(t),i=s.call(arguments),o=S.Deferred(),a=function(t){return function(e){r[t]=this,i[t]=1<arguments.length?s.call(arguments):e,--n||o.resolveWith(r,i)}};if(n<=1&&(I(e,o.done(a(t)).resolve,o.reject,!n),"pending"===o.state()||m(i[t]&&i[t].then)))return o.then();while(t--)I(i[t],a(t),o.reject);return o.promise()}});var W=/^(Eval|Internal|Range|Reference|Syntax|Type|URI)Error$/;S.Deferred.exceptionHook=function(e,t){C.console&&C.console.warn&&e&&W.test(e.name)&&C.console.warn("jQuery.Deferred exception: "+e.message,e.stack,t)},S.readyException=function(e){C.setTimeout(function(){throw e})};var F=S.Deferred();function B(){E.removeEventListener("DOMContentLoaded",B),C.removeEventListener("load",B),S.ready()}S.fn.ready=function(e){return F.then(e)["catch"](function(e){S.readyException(e)}),this},S.extend({isReady:!1,readyWait:1,ready:function(e){(!0===e?--S.readyWait:S.isReady)||(S.isReady=!0)!==e&&0<--S.readyWait||F.resolveWith(E,[S])}}),S.ready.then=F.then,"complete"===E.readyState||"loading"!==E.readyState&&!E.documentElement.doScroll?C.setTimeout(S.ready):(E.addEventListener("DOMContentLoaded",B),C.addEventListener("load",B));var $=function(e,t,n,r,i,o,a){var s=0,u=e.length,l=null==n;if("object"===w(n))for(s in i=!0,n)$(e,t,s,n[s],!0,o,a);else if(void 0!==r&&(i=!0,m(r)||(a=!0),l&&(a?(t.call(e,r),t=null):(l=t,t=function(e,t,n){return l.call(S(e),n)})),t))for(;s<u;s++)t(e[s],n,a?r:r.call(e[s],s,t(e[s],n)));return i?e:l?t.call(e):u?t(e[0],n):o},_=/^-ms-/,z=/-([a-z])/g;function U(e,t){return t.toUpperCase()}function X(e){return e.replace(_,"ms-").replace(z,U)}var V=function(e){return 1===e.nodeType||9===e.nodeType||!+e.nodeType};function G(){this.expando=S.expando+G.uid++}G.uid=1,G.prototype={cache:function(e){var t=e[this.expando];return t||(t={},V(e)&&(e.nodeType?e[this.expando]=t:Object.defineProperty(e,this.expando,{value:t,configurable:!0}))),t},set:function(e,t,n){var r,i=this.cache(e);if("string"==typeof t)i[X(t)]=n;else for(r in t)i[X(r)]=t[r];return i},get:function(e,t){return void 0===t?this.cache(e):e[this.expando]&&e[this.expando][X(t)]},access:function(e,t,n){return void 0===t||t&&"string"==typeof t&&void 0===n?this.get(e,t):(this.set(e,t,n),void 0!==n?n:t)},remove:function(e,t){var n,r=e[this.expando];if(void 0!==r){if(void 0!==t){n=(t=Array.isArray(t)?t.map(X):(t=X(t))in r?[t]:t.match(P)||[]).length;while(n--)delete r[t[n]]}(void 0===t||S.isEmptyObject(r))&&(e.nodeType?e[this.expando]=void 0:delete e[this.expando])}},hasData:function(e){var t=e[this.expando];return void 0!==t&&!S.isEmptyObject(t)}};var Y=new G,Q=new G,J=/^(?:\{[\w\W]*\}|\[[\w\W]*\])$/,K=/[A-Z]/g;function Z(e,t,n){var r,i;if(void 0===n&&1===e.nodeType)if(r="data-"+t.replace(K,"-$&").toLowerCase(),"string"==typeof(n=e.getAttribute(r))){try{n="true"===(i=n)||"false"!==i&&("null"===i?null:i===+i+""?+i:J.test(i)?JSON.parse(i):i)}catch(e){}Q.set(e,t,n)}else n=void 0;return n}S.extend({hasData:function(e){return Q.hasData(e)||Y.hasData(e)},data:function(e,t,n){return Q.access(e,t,n)},removeData:function(e,t){Q.remove(e,t)},_data:function(e,t,n){return Y.access(e,t,n)},_removeData:function(e,t){Y.remove(e,t)}}),S.fn.extend({data:function(n,e){var t,r,i,o=this[0],a=o&&o.attributes;if(void 0===n){if(this.length&&(i=Q.get(o),1===o.nodeType&&!Y.get(o,"hasDataAttrs"))){t=a.length;while(t--)a[t]&&0===(r=a[t].name).indexOf("data-")&&(r=X(r.slice(5)),Z(o,r,i[r]));Y.set(o,"hasDataAttrs",!0)}return i}return"object"==typeof n?this.each(function(){Q.set(this,n)}):$(this,function(e){var t;if(o&&void 0===e)return void 0!==(t=Q.get(o,n))?t:void 0!==(t=Z(o,n))?t:void 0;this.each(function(){Q.set(this,n,e)})},null,e,1<arguments.length,null,!0)},removeData:function(e){return this.each(function(){Q.remove(this,e)})}}),S.extend({queue:function(e,t,n){var r;if(e)return t=(t||"fx")+"queue",r=Y.get(e,t),n&&(!r||Array.isArray(n)?r=Y.access(e,t,S.makeArray(n)):r.push(n)),r||[]},dequeue:function(e,t){t=t||"fx";var n=S.queue(e,t),r=n.length,i=n.shift(),o=S._queueHooks(e,t);"inprogress"===i&&(i=n.shift(),r--),i&&("fx"===t&&n.unshift("inprogress"),delete o.stop,i.call(e,function(){S.dequeue(e,t)},o)),!r&&o&&o.empty.fire()},_queueHooks:function(e,t){var n=t+"queueHooks";return Y.get(e,n)||Y.access(e,n,{empty:S.Callbacks("once memory").add(function(){Y.remove(e,[t+"queue",n])})})}}),S.fn.extend({queue:function(t,n){var e=2;return"string"!=typeof t&&(n=t,t="fx",e--),arguments.length<e?S.queue(this[0],t):void 0===n?this:this.each(function(){var e=S.queue(this,t,n);S._queueHooks(this,t),"fx"===t&&"inprogress"!==e[0]&&S.dequeue(this,t)})},dequeue:function(e){return this.each(function(){S.dequeue(this,e)})},clearQueue:function(e){return this.queue(e||"fx",[])},promise:function(e,t){var n,r=1,i=S.Deferred(),o=this,a=this.length,s=function(){--r||i.resolveWith(o,[o])};"string"!=typeof e&&(t=e,e=void 0),e=e||"fx";while(a--)(n=Y.get(o[a],e+"queueHooks"))&&n.empty&&(r++,n.empty.add(s));return s(),i.promise(t)}});var ee=/[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source,te=new RegExp("^(?:([+-])=|)("+ee+")([a-z%]*)$","i"),ne=["Top","Right","Bottom","Left"],re=E.documentElement,ie=function(e){return S.contains(e.ownerDocument,e)},oe={composed:!0};re.getRootNode&&(ie=function(e){return S.contains(e.ownerDocument,e)||e.getRootNode(oe)===e.ownerDocument});var ae=function(e,t){return"none"===(e=t||e).style.display||""===e.style.display&&ie(e)&&"none"===S.css(e,"display")};function se(e,t,n,r){var i,o,a=20,s=r?function(){return r.cur()}:function(){return S.css(e,t,"")},u=s(),l=n&&n[3]||(S.cssNumber[t]?"":"px"),c=e.nodeType&&(S.cssNumber[t]||"px"!==l&&+u)&&te.exec(S.css(e,t));if(c&&c[3]!==l){u/=2,l=l||c[3],c=+u||1;while(a--)S.style(e,t,c+l),(1-o)*(1-(o=s()/u||.5))<=0&&(a=0),c/=o;c*=2,S.style(e,t,c+l),n=n||[]}return n&&(c=+c||+u||0,i=n[1]?c+(n[1]+1)*n[2]:+n[2],r&&(r.unit=l,r.start=c,r.end=i)),i}var ue={};function le(e,t){for(var n,r,i,o,a,s,u,l=[],c=0,f=e.length;c<f;c++)(r=e[c]).style&&(n=r.style.display,t?("none"===n&&(l[c]=Y.get(r,"display")||null,l[c]||(r.style.display="")),""===r.style.display&&ae(r)&&(l[c]=(u=a=o=void 0,a=(i=r).ownerDocument,s=i.nodeName,(u=ue[s])||(o=a.body.appendChild(a.createElement(s)),u=S.css(o,"display"),o.parentNode.removeChild(o),"none"===u&&(u="block"),ue[s]=u)))):"none"!==n&&(l[c]="none",Y.set(r,"display",n)));for(c=0;c<f;c++)null!=l[c]&&(e[c].style.display=l[c]);return e}S.fn.extend({show:function(){return le(this,!0)},hide:function(){return le(this)},toggle:function(e){return"boolean"==typeof e?e?this.show():this.hide():this.each(function(){ae(this)?S(this).show():S(this).hide()})}});var ce,fe,pe=/^(?:checkbox|radio)$/i,de=/<([a-z][^\/\0>\x20\t\r\n\f]*)/i,he=/^$|^module$|\/(?:java|ecma)script/i;ce=E.createDocumentFragment().appendChild(E.createElement("div")),(fe=E.createElement("input")).setAttribute("type","radio"),fe.setAttribute("checked","checked"),fe.setAttribute("name","t"),ce.appendChild(fe),y.checkClone=ce.cloneNode(!0).cloneNode(!0).lastChild.checked,ce.innerHTML="<textarea>x</textarea>",y.noCloneChecked=!!ce.cloneNode(!0).lastChild.defaultValue,ce.innerHTML="<option></option>",y.option=!!ce.lastChild;var ge={thead:[1,"<table>","</table>"],col:[2,"<table><colgroup>","</colgroup></table>"],tr:[2,"<table><tbody>","</tbody></table>"],td:[3,"<table><tbody><tr>","</tr></tbody></table>"],_default:[0,"",""]};function ve(e,t){var n;return n="undefined"!=typeof e.getElementsByTagName?e.getElementsByTagName(t||"*"):"undefined"!=typeof e.querySelectorAll?e.querySelectorAll(t||"*"):[],void 0===t||t&&A(e,t)?S.merge([e],n):n}function ye(e,t){for(var n=0,r=e.length;n<r;n++)Y.set(e[n],"globalEval",!t||Y.get(t[n],"globalEval"))}ge.tbody=ge.tfoot=ge.colgroup=ge.caption=ge.thead,ge.th=ge.td,y.option||(ge.optgroup=ge.option=[1,"<select multiple='multiple'>","</select>"]);var me=/<|&#?\w+;/;function xe(e,t,n,r,i){for(var o,a,s,u,l,c,f=t.createDocumentFragment(),p=[],d=0,h=e.length;d<h;d++)if((o=e[d])||0===o)if("object"===w(o))S.merge(p,o.nodeType?[o]:o);else if(me.test(o)){a=a||f.appendChild(t.createElement("div")),s=(de.exec(o)||["",""])[1].toLowerCase(),u=ge[s]||ge._default,a.innerHTML=u[1]+S.htmlPrefilter(o)+u[2],c=u[0];while(c--)a=a.lastChild;S.merge(p,a.childNodes),(a=f.firstChild).textContent=""}else p.push(t.createTextNode(o));f.textContent="",d=0;while(o=p[d++])if(r&&-1<S.inArray(o,r))i&&i.push(o);else if(l=ie(o),a=ve(f.appendChild(o),"script"),l&&ye(a),n){c=0;while(o=a[c++])he.test(o.type||"")&&n.push(o)}return f}var be=/^([^.]*)(?:\.(.+)|)/;function we(){return!0}function Te(){return!1}function Ce(e,t){return e===function(){try{return E.activeElement}catch(e){}}()==("focus"===t)}function Ee(e,t,n,r,i,o){var a,s;if("object"==typeof t){for(s in"string"!=typeof n&&(r=r||n,n=void 0),t)Ee(e,s,n,r,t[s],o);return e}if(null==r&&null==i?(i=n,r=n=void 0):null==i&&("string"==typeof n?(i=r,r=void 0):(i=r,r=n,n=void 0)),!1===i)i=Te;else if(!i)return e;return 1===o&&(a=i,(i=function(e){return S().off(e),a.apply(this,arguments)}).guid=a.guid||(a.guid=S.guid++)),e.each(function(){S.event.add(this,t,i,r,n)})}function Se(e,i,o){o?(Y.set(e,i,!1),S.event.add(e,i,{namespace:!1,handler:function(e){var t,n,r=Y.get(this,i);if(1&e.isTrigger&&this[i]){if(r.length)(S.event.special[i]||{}).delegateType&&e.stopPropagation();else if(r=s.call(arguments),Y.set(this,i,r),t=o(this,i),this[i](),r!==(n=Y.get(this,i))||t?Y.set(this,i,!1):n={},r!==n)return e.stopImmediatePropagation(),e.preventDefault(),n&&n.value}else r.length&&(Y.set(this,i,{value:S.event.trigger(S.extend(r[0],S.Event.prototype),r.slice(1),this)}),e.stopImmediatePropagation())}})):void 0===Y.get(e,i)&&S.event.add(e,i,we)}S.event={global:{},add:function(t,e,n,r,i){var o,a,s,u,l,c,f,p,d,h,g,v=Y.get(t);if(V(t)){n.handler&&(n=(o=n).handler,i=o.selector),i&&S.find.matchesSelector(re,i),n.guid||(n.guid=S.guid++),(u=v.events)||(u=v.events=Object.create(null)),(a=v.handle)||(a=v.handle=function(e){return"undefined"!=typeof S&&S.event.triggered!==e.type?S.event.dispatch.apply(t,arguments):void 0}),l=(e=(e||"").match(P)||[""]).length;while(l--)d=g=(s=be.exec(e[l])||[])[1],h=(s[2]||"").split(".").sort(),d&&(f=S.event.special[d]||{},d=(i?f.delegateType:f.bindType)||d,f=S.event.special[d]||{},c=S.extend({type:d,origType:g,data:r,handler:n,guid:n.guid,selector:i,needsContext:i&&S.expr.match.needsContext.test(i),namespace:h.join(".")},o),(p=u[d])||((p=u[d]=[]).delegateCount=0,f.setup&&!1!==f.setup.call(t,r,h,a)||t.addEventListener&&t.addEventListener(d,a)),f.add&&(f.add.call(t,c),c.handler.guid||(c.handler.guid=n.guid)),i?p.splice(p.delegateCount++,0,c):p.push(c),S.event.global[d]=!0)}},remove:function(e,t,n,r,i){var o,a,s,u,l,c,f,p,d,h,g,v=Y.hasData(e)&&Y.get(e);if(v&&(u=v.events)){l=(t=(t||"").match(P)||[""]).length;while(l--)if(d=g=(s=be.exec(t[l])||[])[1],h=(s[2]||"").split(".").sort(),d){f=S.event.special[d]||{},p=u[d=(r?f.delegateType:f.bindType)||d]||[],s=s[2]&&new RegExp("(^|\\.)"+h.join("\\.(?:.*\\.|)")+"(\\.|$)"),a=o=p.length;while(o--)c=p[o],!i&&g!==c.origType||n&&n.guid!==c.guid||s&&!s.test(c.namespace)||r&&r!==c.selector&&("**"!==r||!c.selector)||(p.splice(o,1),c.selector&&p.delegateCount--,f.remove&&f.remove.call(e,c));a&&!p.length&&(f.teardown&&!1!==f.teardown.call(e,h,v.handle)||S.removeEvent(e,d,v.handle),delete u[d])}else for(d in u)S.event.remove(e,d+t[l],n,r,!0);S.isEmptyObject(u)&&Y.remove(e,"handle events")}},dispatch:function(e){var t,n,r,i,o,a,s=new Array(arguments.length),u=S.event.fix(e),l=(Y.get(this,"events")||Object.create(null))[u.type]||[],c=S.event.special[u.type]||{};for(s[0]=u,t=1;t<arguments.length;t++)s[t]=arguments[t];if(u.delegateTarget=this,!c.preDispatch||!1!==c.preDispatch.call(this,u)){a=S.event.handlers.call(this,u,l),t=0;while((i=a[t++])&&!u.isPropagationStopped()){u.currentTarget=i.elem,n=0;while((o=i.handlers[n++])&&!u.isImmediatePropagationStopped())u.rnamespace&&!1!==o.namespace&&!u.rnamespace.test(o.namespace)||(u.handleObj=o,u.data=o.data,void 0!==(r=((S.event.special[o.origType]||{}).handle||o.handler).apply(i.elem,s))&&!1===(u.result=r)&&(u.preventDefault(),u.stopPropagation()))}return c.postDispatch&&c.postDispatch.call(this,u),u.result}},handlers:function(e,t){var n,r,i,o,a,s=[],u=t.delegateCount,l=e.target;if(u&&l.nodeType&&!("click"===e.type&&1<=e.button))for(;l!==this;l=l.parentNode||this)if(1===l.nodeType&&("click"!==e.type||!0!==l.disabled)){for(o=[],a={},n=0;n<u;n++)void 0===a[i=(r=t[n]).selector+" "]&&(a[i]=r.needsContext?-1<S(i,this).index(l):S.find(i,this,null,[l]).length),a[i]&&o.push(r);o.length&&s.push({elem:l,handlers:o})}return l=this,u<t.length&&s.push({elem:l,handlers:t.slice(u)}),s},addProp:function(t,e){Object.defineProperty(S.Event.prototype,t,{enumerable:!0,configurable:!0,get:m(e)?function(){if(this.originalEvent)return e(this.originalEvent)}:function(){if(this.originalEvent)return this.originalEvent[t]},set:function(e){Object.defineProperty(this,t,{enumerable:!0,configurable:!0,writable:!0,value:e})}})},fix:function(e){return e[S.expando]?e:new S.Event(e)},special:{load:{noBubble:!0},click:{setup:function(e){var t=this||e;return pe.test(t.type)&&t.click&&A(t,"input")&&Se(t,"click",we),!1},trigger:function(e){var t=this||e;return pe.test(t.type)&&t.click&&A(t,"input")&&Se(t,"click"),!0},_default:function(e){var t=e.target;return pe.test(t.type)&&t.click&&A(t,"input")&&Y.get(t,"click")||A(t,"a")}},beforeunload:{postDispatch:function(e){void 0!==e.result&&e.originalEvent&&(e.originalEvent.returnValue=e.result)}}}},S.removeEvent=function(e,t,n){e.removeEventListener&&e.removeEventListener(t,n)},S.Event=function(e,t){if(!(this instanceof S.Event))return new S.Event(e,t);e&&e.type?(this.originalEvent=e,this.type=e.type,this.isDefaultPrevented=e.defaultPrevented||void 0===e.defaultPrevented&&!1===e.returnValue?we:Te,this.target=e.target&&3===e.target.nodeType?e.target.parentNode:e.target,this.currentTarget=e.currentTarget,this.relatedTarget=e.relatedTarget):this.type=e,t&&S.extend(this,t),this.timeStamp=e&&e.timeStamp||Date.now(),this[S.expando]=!0},S.Event.prototype={constructor:S.Event,isDefaultPrevented:Te,isPropagationStopped:Te,isImmediatePropagationStopped:Te,isSimulated:!1,preventDefault:function(){var e=this.originalEvent;this.isDefaultPrevented=we,e&&!this.isSimulated&&e.preventDefault()},stopPropagation:function(){var e=this.originalEvent;this.isPropagationStopped=we,e&&!this.isSimulated&&e.stopPropagation()},stopImmediatePropagation:function(){var e=this.originalEvent;this.isImmediatePropagationStopped=we,e&&!this.isSimulated&&e.stopImmediatePropagation(),this.stopPropagation()}},S.each({altKey:!0,bubbles:!0,cancelable:!0,changedTouches:!0,ctrlKey:!0,detail:!0,eventPhase:!0,metaKey:!0,pageX:!0,pageY:!0,shiftKey:!0,view:!0,"char":!0,code:!0,charCode:!0,key:!0,keyCode:!0,button:!0,buttons:!0,clientX:!0,clientY:!0,offsetX:!0,offsetY:!0,pointerId:!0,pointerType:!0,screenX:!0,screenY:!0,targetTouches:!0,toElement:!0,touches:!0,which:!0},S.event.addProp),S.each({focus:"focusin",blur:"focusout"},function(e,t){S.event.special[e]={setup:function(){return Se(this,e,Ce),!1},trigger:function(){return Se(this,e),!0},_default:function(){return!0},delegateType:t}}),S.each({mouseenter:"mouseover",mouseleave:"mouseout",pointerenter:"pointerover",pointerleave:"pointerout"},function(e,i){S.event.special[e]={delegateType:i,bindType:i,handle:function(e){var t,n=e.relatedTarget,r=e.handleObj;return n&&(n===this||S.contains(this,n))||(e.type=r.origType,t=r.handler.apply(this,arguments),e.type=i),t}}}),S.fn.extend({on:function(e,t,n,r){return Ee(this,e,t,n,r)},one:function(e,t,n,r){return Ee(this,e,t,n,r,1)},off:function(e,t,n){var r,i;if(e&&e.preventDefault&&e.handleObj)return r=e.handleObj,S(e.delegateTarget).off(r.namespace?r.origType+"."+r.namespace:r.origType,r.selector,r.handler),this;if("object"==typeof e){for(i in e)this.off(i,t,e[i]);return this}return!1!==t&&"function"!=typeof t||(n=t,t=void 0),!1===n&&(n=Te),this.each(function(){S.event.remove(this,e,n,t)})}});var ke=/<script|<style|<link/i,Ae=/checked\s*(?:[^=]|=\s*.checked.)/i,Ne=/^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g;function je(e,t){return A(e,"table")&&A(11!==t.nodeType?t:t.firstChild,"tr")&&S(e).children("tbody")[0]||e}function De(e){return e.type=(null!==e.getAttribute("type"))+"/"+e.type,e}function qe(e){return"true/"===(e.type||"").slice(0,5)?e.type=e.type.slice(5):e.removeAttribute("type"),e}function Le(e,t){var n,r,i,o,a,s;if(1===t.nodeType){if(Y.hasData(e)&&(s=Y.get(e).events))for(i in Y.remove(t,"handle events"),s)for(n=0,r=s[i].length;n<r;n++)S.event.add(t,i,s[i][n]);Q.hasData(e)&&(o=Q.access(e),a=S.extend({},o),Q.set(t,a))}}function He(n,r,i,o){r=g(r);var e,t,a,s,u,l,c=0,f=n.length,p=f-1,d=r[0],h=m(d);if(h||1<f&&"string"==typeof d&&!y.checkClone&&Ae.test(d))return n.each(function(e){var t=n.eq(e);h&&(r[0]=d.call(this,e,t.html())),He(t,r,i,o)});if(f&&(t=(e=xe(r,n[0].ownerDocument,!1,n,o)).firstChild,1===e.childNodes.length&&(e=t),t||o)){for(s=(a=S.map(ve(e,"script"),De)).length;c<f;c++)u=e,c!==p&&(u=S.clone(u,!0,!0),s&&S.merge(a,ve(u,"script"))),i.call(n[c],u,c);if(s)for(l=a[a.length-1].ownerDocument,S.map(a,qe),c=0;c<s;c++)u=a[c],he.test(u.type||"")&&!Y.access(u,"globalEval")&&S.contains(l,u)&&(u.src&&"module"!==(u.type||"").toLowerCase()?S._evalUrl&&!u.noModule&&S._evalUrl(u.src,{nonce:u.nonce||u.getAttribute("nonce")},l):b(u.textContent.replace(Ne,""),u,l))}return n}function Oe(e,t,n){for(var r,i=t?S.filter(t,e):e,o=0;null!=(r=i[o]);o++)n||1!==r.nodeType||S.cleanData(ve(r)),r.parentNode&&(n&&ie(r)&&ye(ve(r,"script")),r.parentNode.removeChild(r));return e}S.extend({htmlPrefilter:function(e){return e},clone:function(e,t,n){var r,i,o,a,s,u,l,c=e.cloneNode(!0),f=ie(e);if(!(y.noCloneChecked||1!==e.nodeType&&11!==e.nodeType||S.isXMLDoc(e)))for(a=ve(c),r=0,i=(o=ve(e)).length;r<i;r++)s=o[r],u=a[r],void 0,"input"===(l=u.nodeName.toLowerCase())&&pe.test(s.type)?u.checked=s.checked:"input"!==l&&"textarea"!==l||(u.defaultValue=s.defaultValue);if(t)if(n)for(o=o||ve(e),a=a||ve(c),r=0,i=o.length;r<i;r++)Le(o[r],a[r]);else Le(e,c);return 0<(a=ve(c,"script")).length&&ye(a,!f&&ve(e,"script")),c},cleanData:function(e){for(var t,n,r,i=S.event.special,o=0;void 0!==(n=e[o]);o++)if(V(n)){if(t=n[Y.expando]){if(t.events)for(r in t.events)i[r]?S.event.remove(n,r):S.removeEvent(n,r,t.handle);n[Y.expando]=void 0}n[Q.expando]&&(n[Q.expando]=void 0)}}}),S.fn.extend({detach:function(e){return Oe(this,e,!0)},remove:function(e){return Oe(this,e)},text:function(e){return $(this,function(e){return void 0===e?S.text(this):this.empty().each(function(){1!==this.nodeType&&11!==this.nodeType&&9!==this.nodeType||(this.textContent=e)})},null,e,arguments.length)},append:function(){return He(this,arguments,function(e){1!==this.nodeType&&11!==this.nodeType&&9!==this.nodeType||je(this,e).appendChild(e)})},prepend:function(){return He(this,arguments,function(e){if(1===this.nodeType||11===this.nodeType||9===this.nodeType){var t=je(this,e);t.insertBefore(e,t.firstChild)}})},before:function(){return He(this,arguments,function(e){this.parentNode&&this.parentNode.insertBefore(e,this)})},after:function(){return He(this,arguments,function(e){this.parentNode&&this.parentNode.insertBefore(e,this.nextSibling)})},empty:function(){for(var e,t=0;null!=(e=this[t]);t++)1===e.nodeType&&(S.cleanData(ve(e,!1)),e.textContent="");return this},clone:function(e,t){return e=null!=e&&e,t=null==t?e:t,this.map(function(){return S.clone(this,e,t)})},html:function(e){return $(this,function(e){var t=this[0]||{},n=0,r=this.length;if(void 0===e&&1===t.nodeType)return t.innerHTML;if("string"==typeof e&&!ke.test(e)&&!ge[(de.exec(e)||["",""])[1].toLowerCase()]){e=S.htmlPrefilter(e);try{for(;n<r;n++)1===(t=this[n]||{}).nodeType&&(S.cleanData(ve(t,!1)),t.innerHTML=e);t=0}catch(e){}}t&&this.empty().append(e)},null,e,arguments.length)},replaceWith:function(){var n=[];return He(this,arguments,function(e){var t=this.parentNode;S.inArray(this,n)<0&&(S.cleanData(ve(this)),t&&t.replaceChild(e,this))},n)}}),S.each({appendTo:"append",prependTo:"prepend",insertBefore:"before",insertAfter:"after",replaceAll:"replaceWith"},function(e,a){S.fn[e]=function(e){for(var t,n=[],r=S(e),i=r.length-1,o=0;o<=i;o++)t=o===i?this:this.clone(!0),S(r[o])[a](t),u.apply(n,t.get());return this.pushStack(n)}});var Pe=new RegExp("^("+ee+")(?!px)[a-z%]+$","i"),Re=function(e){var t=e.ownerDocument.defaultView;return t&&t.opener||(t=C),t.getComputedStyle(e)},Me=function(e,t,n){var r,i,o={};for(i in t)o[i]=e.style[i],e.style[i]=t[i];for(i in r=n.call(e),t)e.style[i]=o[i];return r},Ie=new RegExp(ne.join("|"),"i");function We(e,t,n){var r,i,o,a,s=e.style;return(n=n||Re(e))&&(""!==(a=n.getPropertyValue(t)||n[t])||ie(e)||(a=S.style(e,t)),!y.pixelBoxStyles()&&Pe.test(a)&&Ie.test(t)&&(r=s.width,i=s.minWidth,o=s.maxWidth,s.minWidth=s.maxWidth=s.width=a,a=n.width,s.width=r,s.minWidth=i,s.maxWidth=o)),void 0!==a?a+"":a}function Fe(e,t){return{get:function(){if(!e())return(this.get=t).apply(this,arguments);delete this.get}}}!function(){function e(){if(l){u.style.cssText="position:absolute;left:-11111px;width:60px;margin-top:1px;padding:0;border:0",l.style.cssText="position:relative;display:block;box-sizing:border-box;overflow:scroll;margin:auto;border:1px;padding:1px;width:60%;top:1%",re.appendChild(u).appendChild(l);var e=C.getComputedStyle(l);n="1%"!==e.top,s=12===t(e.marginLeft),l.style.right="60%",o=36===t(e.right),r=36===t(e.width),l.style.position="absolute",i=12===t(l.offsetWidth/3),re.removeChild(u),l=null}}function t(e){return Math.round(parseFloat(e))}var n,r,i,o,a,s,u=E.createElement("div"),l=E.createElement("div");l.style&&(l.style.backgroundClip="content-box",l.cloneNode(!0).style.backgroundClip="",y.clearCloneStyle="content-box"===l.style.backgroundClip,S.extend(y,{boxSizingReliable:function(){return e(),r},pixelBoxStyles:function(){return e(),o},pixelPosition:function(){return e(),n},reliableMarginLeft:function(){return e(),s},scrollboxSize:function(){return e(),i},reliableTrDimensions:function(){var e,t,n,r;return null==a&&(e=E.createElement("table"),t=E.createElement("tr"),n=E.createElement("div"),e.style.cssText="position:absolute;left:-11111px;border-collapse:separate",t.style.cssText="border:1px solid",t.style.height="1px",n.style.height="9px",n.style.display="block",re.appendChild(e).appendChild(t).appendChild(n),r=C.getComputedStyle(t),a=parseInt(r.height,10)+parseInt(r.borderTopWidth,10)+parseInt(r.borderBottomWidth,10)===t.offsetHeight,re.removeChild(e)),a}}))}();var Be=["Webkit","Moz","ms"],$e=E.createElement("div").style,_e={};function ze(e){var t=S.cssProps[e]||_e[e];return t||(e in $e?e:_e[e]=function(e){var t=e[0].toUpperCase()+e.slice(1),n=Be.length;while(n--)if((e=Be[n]+t)in $e)return e}(e)||e)}var Ue=/^(none|table(?!-c[ea]).+)/,Xe=/^--/,Ve={position:"absolute",visibility:"hidden",display:"block"},Ge={letterSpacing:"0",fontWeight:"400"};function Ye(e,t,n){var r=te.exec(t);return r?Math.max(0,r[2]-(n||0))+(r[3]||"px"):t}function Qe(e,t,n,r,i,o){var a="width"===t?1:0,s=0,u=0;if(n===(r?"border":"content"))return 0;for(;a<4;a+=2)"margin"===n&&(u+=S.css(e,n+ne[a],!0,i)),r?("content"===n&&(u-=S.css(e,"padding"+ne[a],!0,i)),"margin"!==n&&(u-=S.css(e,"border"+ne[a]+"Width",!0,i))):(u+=S.css(e,"padding"+ne[a],!0,i),"padding"!==n?u+=S.css(e,"border"+ne[a]+"Width",!0,i):s+=S.css(e,"border"+ne[a]+"Width",!0,i));return!r&&0<=o&&(u+=Math.max(0,Math.ceil(e["offset"+t[0].toUpperCase()+t.slice(1)]-o-u-s-.5))||0),u}function Je(e,t,n){var r=Re(e),i=(!y.boxSizingReliable()||n)&&"border-box"===S.css(e,"boxSizing",!1,r),o=i,a=We(e,t,r),s="offset"+t[0].toUpperCase()+t.slice(1);if(Pe.test(a)){if(!n)return a;a="auto"}return(!y.boxSizingReliable()&&i||!y.reliableTrDimensions()&&A(e,"tr")||"auto"===a||!parseFloat(a)&&"inline"===S.css(e,"display",!1,r))&&e.getClientRects().length&&(i="border-box"===S.css(e,"boxSizing",!1,r),(o=s in e)&&(a=e[s])),(a=parseFloat(a)||0)+Qe(e,t,n||(i?"border":"content"),o,r,a)+"px"}function Ke(e,t,n,r,i){return new Ke.prototype.init(e,t,n,r,i)}S.extend({cssHooks:{opacity:{get:function(e,t){if(t){var n=We(e,"opacity");return""===n?"1":n}}}},cssNumber:{animationIterationCount:!0,columnCount:!0,fillOpacity:!0,flexGrow:!0,flexShrink:!0,fontWeight:!0,gridArea:!0,gridColumn:!0,gridColumnEnd:!0,gridColumnStart:!0,gridRow:!0,gridRowEnd:!0,gridRowStart:!0,lineHeight:!0,opacity:!0,order:!0,orphans:!0,widows:!0,zIndex:!0,zoom:!0},cssProps:{},style:function(e,t,n,r){if(e&&3!==e.nodeType&&8!==e.nodeType&&e.style){var i,o,a,s=X(t),u=Xe.test(t),l=e.style;if(u||(t=ze(s)),a=S.cssHooks[t]||S.cssHooks[s],void 0===n)return a&&"get"in a&&void 0!==(i=a.get(e,!1,r))?i:l[t];"string"===(o=typeof n)&&(i=te.exec(n))&&i[1]&&(n=se(e,t,i),o="number"),null!=n&&n==n&&("number"!==o||u||(n+=i&&i[3]||(S.cssNumber[s]?"":"px")),y.clearCloneStyle||""!==n||0!==t.indexOf("background")||(l[t]="inherit"),a&&"set"in a&&void 0===(n=a.set(e,n,r))||(u?l.setProperty(t,n):l[t]=n))}},css:function(e,t,n,r){var i,o,a,s=X(t);return Xe.test(t)||(t=ze(s)),(a=S.cssHooks[t]||S.cssHooks[s])&&"get"in a&&(i=a.get(e,!0,n)),void 0===i&&(i=We(e,t,r)),"normal"===i&&t in Ge&&(i=Ge[t]),""===n||n?(o=parseFloat(i),!0===n||isFinite(o)?o||0:i):i}}),S.each(["height","width"],function(e,u){S.cssHooks[u]={get:function(e,t,n){if(t)return!Ue.test(S.css(e,"display"))||e.getClientRects().length&&e.getBoundingClientRect().width?Je(e,u,n):Me(e,Ve,function(){return Je(e,u,n)})},set:function(e,t,n){var r,i=Re(e),o=!y.scrollboxSize()&&"absolute"===i.position,a=(o||n)&&"border-box"===S.css(e,"boxSizing",!1,i),s=n?Qe(e,u,n,a,i):0;return a&&o&&(s-=Math.ceil(e["offset"+u[0].toUpperCase()+u.slice(1)]-parseFloat(i[u])-Qe(e,u,"border",!1,i)-.5)),s&&(r=te.exec(t))&&"px"!==(r[3]||"px")&&(e.style[u]=t,t=S.css(e,u)),Ye(0,t,s)}}}),S.cssHooks.marginLeft=Fe(y.reliableMarginLeft,function(e,t){if(t)return(parseFloat(We(e,"marginLeft"))||e.getBoundingClientRect().left-Me(e,{marginLeft:0},function(){return e.getBoundingClientRect().left}))+"px"}),S.each({margin:"",padding:"",border:"Width"},function(i,o){S.cssHooks[i+o]={expand:function(e){for(var t=0,n={},r="string"==typeof e?e.split(" "):[e];t<4;t++)n[i+ne[t]+o]=r[t]||r[t-2]||r[0];return n}},"margin"!==i&&(S.cssHooks[i+o].set=Ye)}),S.fn.extend({css:function(e,t){return $(this,function(e,t,n){var r,i,o={},a=0;if(Array.isArray(t)){for(r=Re(e),i=t.length;a<i;a++)o[t[a]]=S.css(e,t[a],!1,r);return o}return void 0!==n?S.style(e,t,n):S.css(e,t)},e,t,1<arguments.length)}}),((S.Tween=Ke).prototype={constructor:Ke,init:function(e,t,n,r,i,o){this.elem=e,this.prop=n,this.easing=i||S.easing._default,this.options=t,this.start=this.now=this.cur(),this.end=r,this.unit=o||(S.cssNumber[n]?"":"px")},cur:function(){var e=Ke.propHooks[this.prop];return e&&e.get?e.get(this):Ke.propHooks._default.get(this)},run:function(e){var t,n=Ke.propHooks[this.prop];return this.options.duration?this.pos=t=S.easing[this.easing](e,this.options.duration*e,0,1,this.options.duration):this.pos=t=e,this.now=(this.end-this.start)*t+this.start,this.options.step&&this.options.step.call(this.elem,this.now,this),n&&n.set?n.set(this):Ke.propHooks._default.set(this),this}}).init.prototype=Ke.prototype,(Ke.propHooks={_default:{get:function(e){var t;return 1!==e.elem.nodeType||null!=e.elem[e.prop]&&null==e.elem.style[e.prop]?e.elem[e.prop]:(t=S.css(e.elem,e.prop,""))&&"auto"!==t?t:0},set:function(e){S.fx.step[e.prop]?S.fx.step[e.prop](e):1!==e.elem.nodeType||!S.cssHooks[e.prop]&&null==e.elem.style[ze(e.prop)]?e.elem[e.prop]=e.now:S.style(e.elem,e.prop,e.now+e.unit)}}}).scrollTop=Ke.propHooks.scrollLeft={set:function(e){e.elem.nodeType&&e.elem.parentNode&&(e.elem[e.prop]=e.now)}},S.easing={linear:function(e){return e},swing:function(e){return.5-Math.cos(e*Math.PI)/2},_default:"swing"},S.fx=Ke.prototype.init,S.fx.step={};var Ze,et,tt,nt,rt=/^(?:toggle|show|hide)$/,it=/queueHooks$/;function ot(){et&&(!1===E.hidden&&C.requestAnimationFrame?C.requestAnimationFrame(ot):C.setTimeout(ot,S.fx.interval),S.fx.tick())}function at(){return C.setTimeout(function(){Ze=void 0}),Ze=Date.now()}function st(e,t){var n,r=0,i={height:e};for(t=t?1:0;r<4;r+=2-t)i["margin"+(n=ne[r])]=i["padding"+n]=e;return t&&(i.opacity=i.width=e),i}function ut(e,t,n){for(var r,i=(lt.tweeners[t]||[]).concat(lt.tweeners["*"]),o=0,a=i.length;o<a;o++)if(r=i[o].call(n,t,e))return r}function lt(o,e,t){var n,a,r=0,i=lt.prefilters.length,s=S.Deferred().always(function(){delete u.elem}),u=function(){if(a)return!1;for(var e=Ze||at(),t=Math.max(0,l.startTime+l.duration-e),n=1-(t/l.duration||0),r=0,i=l.tweens.length;r<i;r++)l.tweens[r].run(n);return s.notifyWith(o,[l,n,t]),n<1&&i?t:(i||s.notifyWith(o,[l,1,0]),s.resolveWith(o,[l]),!1)},l=s.promise({elem:o,props:S.extend({},e),opts:S.extend(!0,{specialEasing:{},easing:S.easing._default},t),originalProperties:e,originalOptions:t,startTime:Ze||at(),duration:t.duration,tweens:[],createTween:function(e,t){var n=S.Tween(o,l.opts,e,t,l.opts.specialEasing[e]||l.opts.easing);return l.tweens.push(n),n},stop:function(e){var t=0,n=e?l.tweens.length:0;if(a)return this;for(a=!0;t<n;t++)l.tweens[t].run(1);return e?(s.notifyWith(o,[l,1,0]),s.resolveWith(o,[l,e])):s.rejectWith(o,[l,e]),this}}),c=l.props;for(!function(e,t){var n,r,i,o,a;for(n in e)if(i=t[r=X(n)],o=e[n],Array.isArray(o)&&(i=o[1],o=e[n]=o[0]),n!==r&&(e[r]=o,delete e[n]),(a=S.cssHooks[r])&&"expand"in a)for(n in o=a.expand(o),delete e[r],o)n in e||(e[n]=o[n],t[n]=i);else t[r]=i}(c,l.opts.specialEasing);r<i;r++)if(n=lt.prefilters[r].call(l,o,c,l.opts))return m(n.stop)&&(S._queueHooks(l.elem,l.opts.queue).stop=n.stop.bind(n)),n;return S.map(c,ut,l),m(l.opts.start)&&l.opts.start.call(o,l),l.progress(l.opts.progress).done(l.opts.done,l.opts.complete).fail(l.opts.fail).always(l.opts.always),S.fx.timer(S.extend(u,{elem:o,anim:l,queue:l.opts.queue})),l}S.Animation=S.extend(lt,{tweeners:{"*":[function(e,t){var n=this.createTween(e,t);return se(n.elem,e,te.exec(t),n),n}]},tweener:function(e,t){m(e)?(t=e,e=["*"]):e=e.match(P);for(var n,r=0,i=e.length;r<i;r++)n=e[r],lt.tweeners[n]=lt.tweeners[n]||[],lt.tweeners[n].unshift(t)},prefilters:[function(e,t,n){var r,i,o,a,s,u,l,c,f="width"in t||"height"in t,p=this,d={},h=e.style,g=e.nodeType&&ae(e),v=Y.get(e,"fxshow");for(r in n.queue||(null==(a=S._queueHooks(e,"fx")).unqueued&&(a.unqueued=0,s=a.empty.fire,a.empty.fire=function(){a.unqueued||s()}),a.unqueued++,p.always(function(){p.always(function(){a.unqueued--,S.queue(e,"fx").length||a.empty.fire()})})),t)if(i=t[r],rt.test(i)){if(delete t[r],o=o||"toggle"===i,i===(g?"hide":"show")){if("show"!==i||!v||void 0===v[r])continue;g=!0}d[r]=v&&v[r]||S.style(e,r)}if((u=!S.isEmptyObject(t))||!S.isEmptyObject(d))for(r in f&&1===e.nodeType&&(n.overflow=[h.overflow,h.overflowX,h.overflowY],null==(l=v&&v.display)&&(l=Y.get(e,"display")),"none"===(c=S.css(e,"display"))&&(l?c=l:(le([e],!0),l=e.style.display||l,c=S.css(e,"display"),le([e]))),("inline"===c||"inline-block"===c&&null!=l)&&"none"===S.css(e,"float")&&(u||(p.done(function(){h.display=l}),null==l&&(c=h.display,l="none"===c?"":c)),h.display="inline-block")),n.overflow&&(h.overflow="hidden",p.always(function(){h.overflow=n.overflow[0],h.overflowX=n.overflow[1],h.overflowY=n.overflow[2]})),u=!1,d)u||(v?"hidden"in v&&(g=v.hidden):v=Y.access(e,"fxshow",{display:l}),o&&(v.hidden=!g),g&&le([e],!0),p.done(function(){for(r in g||le([e]),Y.remove(e,"fxshow"),d)S.style(e,r,d[r])})),u=ut(g?v[r]:0,r,p),r in v||(v[r]=u.start,g&&(u.end=u.start,u.start=0))}],prefilter:function(e,t){t?lt.prefilters.unshift(e):lt.prefilters.push(e)}}),S.speed=function(e,t,n){var r=e&&"object"==typeof e?S.extend({},e):{complete:n||!n&&t||m(e)&&e,duration:e,easing:n&&t||t&&!m(t)&&t};return S.fx.off?r.duration=0:"number"!=typeof r.duration&&(r.duration in S.fx.speeds?r.duration=S.fx.speeds[r.duration]:r.duration=S.fx.speeds._default),null!=r.queue&&!0!==r.queue||(r.queue="fx"),r.old=r.complete,r.complete=function(){m(r.old)&&r.old.call(this),r.queue&&S.dequeue(this,r.queue)},r},S.fn.extend({fadeTo:function(e,t,n,r){return this.filter(ae).css("opacity",0).show().end().animate({opacity:t},e,n,r)},animate:function(t,e,n,r){var i=S.isEmptyObject(t),o=S.speed(e,n,r),a=function(){var e=lt(this,S.extend({},t),o);(i||Y.get(this,"finish"))&&e.stop(!0)};return a.finish=a,i||!1===o.queue?this.each(a):this.queue(o.queue,a)},stop:function(i,e,o){var a=function(e){var t=e.stop;delete e.stop,t(o)};return"string"!=typeof i&&(o=e,e=i,i=void 0),e&&this.queue(i||"fx",[]),this.each(function(){var e=!0,t=null!=i&&i+"queueHooks",n=S.timers,r=Y.get(this);if(t)r[t]&&r[t].stop&&a(r[t]);else for(t in r)r[t]&&r[t].stop&&it.test(t)&&a(r[t]);for(t=n.length;t--;)n[t].elem!==this||null!=i&&n[t].queue!==i||(n[t].anim.stop(o),e=!1,n.splice(t,1));!e&&o||S.dequeue(this,i)})},finish:function(a){return!1!==a&&(a=a||"fx"),this.each(function(){var e,t=Y.get(this),n=t[a+"queue"],r=t[a+"queueHooks"],i=S.timers,o=n?n.length:0;for(t.finish=!0,S.queue(this,a,[]),r&&r.stop&&r.stop.call(this,!0),e=i.length;e--;)i[e].elem===this&&i[e].queue===a&&(i[e].anim.stop(!0),i.splice(e,1));for(e=0;e<o;e++)n[e]&&n[e].finish&&n[e].finish.call(this);delete t.finish})}}),S.each(["toggle","show","hide"],function(e,r){var i=S.fn[r];S.fn[r]=function(e,t,n){return null==e||"boolean"==typeof e?i.apply(this,arguments):this.animate(st(r,!0),e,t,n)}}),S.each({slideDown:st("show"),slideUp:st("hide"),slideToggle:st("toggle"),fadeIn:{opacity:"show"},fadeOut:{opacity:"hide"},fadeToggle:{opacity:"toggle"}},function(e,r){S.fn[e]=function(e,t,n){return this.animate(r,e,t,n)}}),S.timers=[],S.fx.tick=function(){var e,t=0,n=S.timers;for(Ze=Date.now();t<n.length;t++)(e=n[t])()||n[t]!==e||n.splice(t--,1);n.length||S.fx.stop(),Ze=void 0},S.fx.timer=function(e){S.timers.push(e),S.fx.start()},S.fx.interval=13,S.fx.start=function(){et||(et=!0,ot())},S.fx.stop=function(){et=null},S.fx.speeds={slow:600,fast:200,_default:400},S.fn.delay=function(r,e){return r=S.fx&&S.fx.speeds[r]||r,e=e||"fx",this.queue(e,function(e,t){var n=C.setTimeout(e,r);t.stop=function(){C.clearTimeout(n)}})},tt=E.createElement("input"),nt=E.createElement("select").appendChild(E.createElement("option")),tt.type="checkbox",y.checkOn=""!==tt.value,y.optSelected=nt.selected,(tt=E.createElement("input")).value="t",tt.type="radio",y.radioValue="t"===tt.value;var ct,ft=S.expr.attrHandle;S.fn.extend({attr:function(e,t){return $(this,S.attr,e,t,1<arguments.length)},removeAttr:function(e){return this.each(function(){S.removeAttr(this,e)})}}),S.extend({attr:function(e,t,n){var r,i,o=e.nodeType;if(3!==o&&8!==o&&2!==o)return"undefined"==typeof e.getAttribute?S.prop(e,t,n):(1===o&&S.isXMLDoc(e)||(i=S.attrHooks[t.toLowerCase()]||(S.expr.match.bool.test(t)?ct:void 0)),void 0!==n?null===n?void S.removeAttr(e,t):i&&"set"in i&&void 0!==(r=i.set(e,n,t))?r:(e.setAttribute(t,n+""),n):i&&"get"in i&&null!==(r=i.get(e,t))?r:null==(r=S.find.attr(e,t))?void 0:r)},attrHooks:{type:{set:function(e,t){if(!y.radioValue&&"radio"===t&&A(e,"input")){var n=e.value;return e.setAttribute("type",t),n&&(e.value=n),t}}}},removeAttr:function(e,t){var n,r=0,i=t&&t.match(P);if(i&&1===e.nodeType)while(n=i[r++])e.removeAttribute(n)}}),ct={set:function(e,t,n){return!1===t?S.removeAttr(e,n):e.setAttribute(n,n),n}},S.each(S.expr.match.bool.source.match(/\w+/g),function(e,t){var a=ft[t]||S.find.attr;ft[t]=function(e,t,n){var r,i,o=t.toLowerCase();return n||(i=ft[o],ft[o]=r,r=null!=a(e,t,n)?o:null,ft[o]=i),r}});var pt=/^(?:input|select|textarea|button)$/i,dt=/^(?:a|area)$/i;function ht(e){return(e.match(P)||[]).join(" ")}function gt(e){return e.getAttribute&&e.getAttribute("class")||""}function vt(e){return Array.isArray(e)?e:"string"==typeof e&&e.match(P)||[]}S.fn.extend({prop:function(e,t){return $(this,S.prop,e,t,1<arguments.length)},removeProp:function(e){return this.each(function(){delete this[S.propFix[e]||e]})}}),S.extend({prop:function(e,t,n){var r,i,o=e.nodeType;if(3!==o&&8!==o&&2!==o)return 1===o&&S.isXMLDoc(e)||(t=S.propFix[t]||t,i=S.propHooks[t]),void 0!==n?i&&"set"in i&&void 0!==(r=i.set(e,n,t))?r:e[t]=n:i&&"get"in i&&null!==(r=i.get(e,t))?r:e[t]},propHooks:{tabIndex:{get:function(e){var t=S.find.attr(e,"tabindex");return t?parseInt(t,10):pt.test(e.nodeName)||dt.test(e.nodeName)&&e.href?0:-1}}},propFix:{"for":"htmlFor","class":"className"}}),y.optSelected||(S.propHooks.selected={get:function(e){var t=e.parentNode;return t&&t.parentNode&&t.parentNode.selectedIndex,null},set:function(e){var t=e.parentNode;t&&(t.selectedIndex,t.parentNode&&t.parentNode.selectedIndex)}}),S.each(["tabIndex","readOnly","maxLength","cellSpacing","cellPadding","rowSpan","colSpan","useMap","frameBorder","contentEditable"],function(){S.propFix[this.toLowerCase()]=this}),S.fn.extend({addClass:function(t){var e,n,r,i,o,a,s,u=0;if(m(t))return this.each(function(e){S(this).addClass(t.call(this,e,gt(this)))});if((e=vt(t)).length)while(n=this[u++])if(i=gt(n),r=1===n.nodeType&&" "+ht(i)+" "){a=0;while(o=e[a++])r.indexOf(" "+o+" ")<0&&(r+=o+" ");i!==(s=ht(r))&&n.setAttribute("class",s)}return this},removeClass:function(t){var e,n,r,i,o,a,s,u=0;if(m(t))return this.each(function(e){S(this).removeClass(t.call(this,e,gt(this)))});if(!arguments.length)return this.attr("class","");if((e=vt(t)).length)while(n=this[u++])if(i=gt(n),r=1===n.nodeType&&" "+ht(i)+" "){a=0;while(o=e[a++])while(-1<r.indexOf(" "+o+" "))r=r.replace(" "+o+" "," ");i!==(s=ht(r))&&n.setAttribute("class",s)}return this},toggleClass:function(i,t){var o=typeof i,a="string"===o||Array.isArray(i);return"boolean"==typeof t&&a?t?this.addClass(i):this.removeClass(i):m(i)?this.each(function(e){S(this).toggleClass(i.call(this,e,gt(this),t),t)}):this.each(function(){var e,t,n,r;if(a){t=0,n=S(this),r=vt(i);while(e=r[t++])n.hasClass(e)?n.removeClass(e):n.addClass(e)}else void 0!==i&&"boolean"!==o||((e=gt(this))&&Y.set(this,"__className__",e),this.setAttribute&&this.setAttribute("class",e||!1===i?"":Y.get(this,"__className__")||""))})},hasClass:function(e){var t,n,r=0;t=" "+e+" ";while(n=this[r++])if(1===n.nodeType&&-1<(" "+ht(gt(n))+" ").indexOf(t))return!0;return!1}});var yt=/\r/g;S.fn.extend({val:function(n){var r,e,i,t=this[0];return arguments.length?(i=m(n),this.each(function(e){var t;1===this.nodeType&&(null==(t=i?n.call(this,e,S(this).val()):n)?t="":"number"==typeof t?t+="":Array.isArray(t)&&(t=S.map(t,function(e){return null==e?"":e+""})),(r=S.valHooks[this.type]||S.valHooks[this.nodeName.toLowerCase()])&&"set"in r&&void 0!==r.set(this,t,"value")||(this.value=t))})):t?(r=S.valHooks[t.type]||S.valHooks[t.nodeName.toLowerCase()])&&"get"in r&&void 0!==(e=r.get(t,"value"))?e:"string"==typeof(e=t.value)?e.replace(yt,""):null==e?"":e:void 0}}),S.extend({valHooks:{option:{get:function(e){var t=S.find.attr(e,"value");return null!=t?t:ht(S.text(e))}},select:{get:function(e){var t,n,r,i=e.options,o=e.selectedIndex,a="select-one"===e.type,s=a?null:[],u=a?o+1:i.length;for(r=o<0?u:a?o:0;r<u;r++)if(((n=i[r]).selected||r===o)&&!n.disabled&&(!n.parentNode.disabled||!A(n.parentNode,"optgroup"))){if(t=S(n).val(),a)return t;s.push(t)}return s},set:function(e,t){var n,r,i=e.options,o=S.makeArray(t),a=i.length;while(a--)((r=i[a]).selected=-1<S.inArray(S.valHooks.option.get(r),o))&&(n=!0);return n||(e.selectedIndex=-1),o}}}}),S.each(["radio","checkbox"],function(){S.valHooks[this]={set:function(e,t){if(Array.isArray(t))return e.checked=-1<S.inArray(S(e).val(),t)}},y.checkOn||(S.valHooks[this].get=function(e){return null===e.getAttribute("value")?"on":e.value})}),y.focusin="onfocusin"in C;var mt=/^(?:focusinfocus|focusoutblur)$/,xt=function(e){e.stopPropagation()};S.extend(S.event,{trigger:function(e,t,n,r){var i,o,a,s,u,l,c,f,p=[n||E],d=v.call(e,"type")?e.type:e,h=v.call(e,"namespace")?e.namespace.split("."):[];if(o=f=a=n=n||E,3!==n.nodeType&&8!==n.nodeType&&!mt.test(d+S.event.triggered)&&(-1<d.indexOf(".")&&(d=(h=d.split(".")).shift(),h.sort()),u=d.indexOf(":")<0&&"on"+d,(e=e[S.expando]?e:new S.Event(d,"object"==typeof e&&e)).isTrigger=r?2:3,e.namespace=h.join("."),e.rnamespace=e.namespace?new RegExp("(^|\\.)"+h.join("\\.(?:.*\\.|)")+"(\\.|$)"):null,e.result=void 0,e.target||(e.target=n),t=null==t?[e]:S.makeArray(t,[e]),c=S.event.special[d]||{},r||!c.trigger||!1!==c.trigger.apply(n,t))){if(!r&&!c.noBubble&&!x(n)){for(s=c.delegateType||d,mt.test(s+d)||(o=o.parentNode);o;o=o.parentNode)p.push(o),a=o;a===(n.ownerDocument||E)&&p.push(a.defaultView||a.parentWindow||C)}i=0;while((o=p[i++])&&!e.isPropagationStopped())f=o,e.type=1<i?s:c.bindType||d,(l=(Y.get(o,"events")||Object.create(null))[e.type]&&Y.get(o,"handle"))&&l.apply(o,t),(l=u&&o[u])&&l.apply&&V(o)&&(e.result=l.apply(o,t),!1===e.result&&e.preventDefault());return e.type=d,r||e.isDefaultPrevented()||c._default&&!1!==c._default.apply(p.pop(),t)||!V(n)||u&&m(n[d])&&!x(n)&&((a=n[u])&&(n[u]=null),S.event.triggered=d,e.isPropagationStopped()&&f.addEventListener(d,xt),n[d](),e.isPropagationStopped()&&f.removeEventListener(d,xt),S.event.triggered=void 0,a&&(n[u]=a)),e.result}},simulate:function(e,t,n){var r=S.extend(new S.Event,n,{type:e,isSimulated:!0});S.event.trigger(r,null,t)}}),S.fn.extend({trigger:function(e,t){return this.each(function(){S.event.trigger(e,t,this)})},triggerHandler:function(e,t){var n=this[0];if(n)return S.event.trigger(e,t,n,!0)}}),y.focusin||S.each({focus:"focusin",blur:"focusout"},function(n,r){var i=function(e){S.event.simulate(r,e.target,S.event.fix(e))};S.event.special[r]={setup:function(){var e=this.ownerDocument||this.document||this,t=Y.access(e,r);t||e.addEventListener(n,i,!0),Y.access(e,r,(t||0)+1)},teardown:function(){var e=this.ownerDocument||this.document||this,t=Y.access(e,r)-1;t?Y.access(e,r,t):(e.removeEventListener(n,i,!0),Y.remove(e,r))}}});var bt=C.location,wt={guid:Date.now()},Tt=/\?/;S.parseXML=function(e){var t,n;if(!e||"string"!=typeof e)return null;try{t=(new C.DOMParser).parseFromString(e,"text/xml")}catch(e){}return n=t&&t.getElementsByTagName("parsererror")[0],t&&!n||S.error("Invalid XML: "+(n?S.map(n.childNodes,function(e){return e.textContent}).join("\n"):e)),t};var Ct=/\[\]$/,Et=/\r?\n/g,St=/^(?:submit|button|image|reset|file)$/i,kt=/^(?:input|select|textarea|keygen)/i;function At(n,e,r,i){var t;if(Array.isArray(e))S.each(e,function(e,t){r||Ct.test(n)?i(n,t):At(n+"["+("object"==typeof t&&null!=t?e:"")+"]",t,r,i)});else if(r||"object"!==w(e))i(n,e);else for(t in e)At(n+"["+t+"]",e[t],r,i)}S.param=function(e,t){var n,r=[],i=function(e,t){var n=m(t)?t():t;r[r.length]=encodeURIComponent(e)+"="+encodeURIComponent(null==n?"":n)};if(null==e)return"";if(Array.isArray(e)||e.jquery&&!S.isPlainObject(e))S.each(e,function(){i(this.name,this.value)});else for(n in e)At(n,e[n],t,i);return r.join("&")},S.fn.extend({serialize:function(){return S.param(this.serializeArray())},serializeArray:function(){return this.map(function(){var e=S.prop(this,"elements");return e?S.makeArray(e):this}).filter(function(){var e=this.type;return this.name&&!S(this).is(":disabled")&&kt.test(this.nodeName)&&!St.test(e)&&(this.checked||!pe.test(e))}).map(function(e,t){var n=S(this).val();return null==n?null:Array.isArray(n)?S.map(n,function(e){return{name:t.name,value:e.replace(Et,"\r\n")}}):{name:t.name,value:n.replace(Et,"\r\n")}}).get()}});var Nt=/%20/g,jt=/#.*$/,Dt=/([?&])_=[^&]*/,qt=/^(.*?):[ \t]*([^\r\n]*)$/gm,Lt=/^(?:GET|HEAD)$/,Ht=/^\/\//,Ot={},Pt={},Rt="*/".concat("*"),Mt=E.createElement("a");function It(o){return function(e,t){"string"!=typeof e&&(t=e,e="*");var n,r=0,i=e.toLowerCase().match(P)||[];if(m(t))while(n=i[r++])"+"===n[0]?(n=n.slice(1)||"*",(o[n]=o[n]||[]).unshift(t)):(o[n]=o[n]||[]).push(t)}}function Wt(t,i,o,a){var s={},u=t===Pt;function l(e){var r;return s[e]=!0,S.each(t[e]||[],function(e,t){var n=t(i,o,a);return"string"!=typeof n||u||s[n]?u?!(r=n):void 0:(i.dataTypes.unshift(n),l(n),!1)}),r}return l(i.dataTypes[0])||!s["*"]&&l("*")}function Ft(e,t){var n,r,i=S.ajaxSettings.flatOptions||{};for(n in t)void 0!==t[n]&&((i[n]?e:r||(r={}))[n]=t[n]);return r&&S.extend(!0,e,r),e}Mt.href=bt.href,S.extend({active:0,lastModified:{},etag:{},ajaxSettings:{url:bt.href,type:"GET",isLocal:/^(?:about|app|app-storage|.+-extension|file|res|widget):$/.test(bt.protocol),global:!0,processData:!0,async:!0,contentType:"application/x-www-form-urlencoded; charset=UTF-8",accepts:{"*":Rt,text:"text/plain",html:"text/html",xml:"application/xml, text/xml",json:"application/json, text/javascript"},contents:{xml:/\bxml\b/,html:/\bhtml/,json:/\bjson\b/},responseFields:{xml:"responseXML",text:"responseText",json:"responseJSON"},converters:{"* text":String,"text html":!0,"text json":JSON.parse,"text xml":S.parseXML},flatOptions:{url:!0,context:!0}},ajaxSetup:function(e,t){return t?Ft(Ft(e,S.ajaxSettings),t):Ft(S.ajaxSettings,e)},ajaxPrefilter:It(Ot),ajaxTransport:It(Pt),ajax:function(e,t){"object"==typeof e&&(t=e,e=void 0),t=t||{};var c,f,p,n,d,r,h,g,i,o,v=S.ajaxSetup({},t),y=v.context||v,m=v.context&&(y.nodeType||y.jquery)?S(y):S.event,x=S.Deferred(),b=S.Callbacks("once memory"),w=v.statusCode||{},a={},s={},u="canceled",T={readyState:0,getResponseHeader:function(e){var t;if(h){if(!n){n={};while(t=qt.exec(p))n[t[1].toLowerCase()+" "]=(n[t[1].toLowerCase()+" "]||[]).concat(t[2])}t=n[e.toLowerCase()+" "]}return null==t?null:t.join(", ")},getAllResponseHeaders:function(){return h?p:null},setRequestHeader:function(e,t){return null==h&&(e=s[e.toLowerCase()]=s[e.toLowerCase()]||e,a[e]=t),this},overrideMimeType:function(e){return null==h&&(v.mimeType=e),this},statusCode:function(e){var t;if(e)if(h)T.always(e[T.status]);else for(t in e)w[t]=[w[t],e[t]];return this},abort:function(e){var t=e||u;return c&&c.abort(t),l(0,t),this}};if(x.promise(T),v.url=((e||v.url||bt.href)+"").replace(Ht,bt.protocol+"//"),v.type=t.method||t.type||v.method||v.type,v.dataTypes=(v.dataType||"*").toLowerCase().match(P)||[""],null==v.crossDomain){r=E.createElement("a");try{r.href=v.url,r.href=r.href,v.crossDomain=Mt.protocol+"//"+Mt.host!=r.protocol+"//"+r.host}catch(e){v.crossDomain=!0}}if(v.data&&v.processData&&"string"!=typeof v.data&&(v.data=S.param(v.data,v.traditional)),Wt(Ot,v,t,T),h)return T;for(i in(g=S.event&&v.global)&&0==S.active++&&S.event.trigger("ajaxStart"),v.type=v.type.toUpperCase(),v.hasContent=!Lt.test(v.type),f=v.url.replace(jt,""),v.hasContent?v.data&&v.processData&&0===(v.contentType||"").indexOf("application/x-www-form-urlencoded")&&(v.data=v.data.replace(Nt,"+")):(o=v.url.slice(f.length),v.data&&(v.processData||"string"==typeof v.data)&&(f+=(Tt.test(f)?"&":"?")+v.data,delete v.data),!1===v.cache&&(f=f.replace(Dt,"$1"),o=(Tt.test(f)?"&":"?")+"_="+wt.guid+++o),v.url=f+o),v.ifModified&&(S.lastModified[f]&&T.setRequestHeader("If-Modified-Since",S.lastModified[f]),S.etag[f]&&T.setRequestHeader("If-None-Match",S.etag[f])),(v.data&&v.hasContent&&!1!==v.contentType||t.contentType)&&T.setRequestHeader("Content-Type",v.contentType),T.setRequestHeader("Accept",v.dataTypes[0]&&v.accepts[v.dataTypes[0]]?v.accepts[v.dataTypes[0]]+("*"!==v.dataTypes[0]?", "+Rt+"; q=0.01":""):v.accepts["*"]),v.headers)T.setRequestHeader(i,v.headers[i]);if(v.beforeSend&&(!1===v.beforeSend.call(y,T,v)||h))return T.abort();if(u="abort",b.add(v.complete),T.done(v.success),T.fail(v.error),c=Wt(Pt,v,t,T)){if(T.readyState=1,g&&m.trigger("ajaxSend",[T,v]),h)return T;v.async&&0<v.timeout&&(d=C.setTimeout(function(){T.abort("timeout")},v.timeout));try{h=!1,c.send(a,l)}catch(e){if(h)throw e;l(-1,e)}}else l(-1,"No Transport");function l(e,t,n,r){var i,o,a,s,u,l=t;h||(h=!0,d&&C.clearTimeout(d),c=void 0,p=r||"",T.readyState=0<e?4:0,i=200<=e&&e<300||304===e,n&&(s=function(e,t,n){var r,i,o,a,s=e.contents,u=e.dataTypes;while("*"===u[0])u.shift(),void 0===r&&(r=e.mimeType||t.getResponseHeader("Content-Type"));if(r)for(i in s)if(s[i]&&s[i].test(r)){u.unshift(i);break}if(u[0]in n)o=u[0];else{for(i in n){if(!u[0]||e.converters[i+" "+u[0]]){o=i;break}a||(a=i)}o=o||a}if(o)return o!==u[0]&&u.unshift(o),n[o]}(v,T,n)),!i&&-1<S.inArray("script",v.dataTypes)&&S.inArray("json",v.dataTypes)<0&&(v.converters["text script"]=function(){}),s=function(e,t,n,r){var i,o,a,s,u,l={},c=e.dataTypes.slice();if(c[1])for(a in e.converters)l[a.toLowerCase()]=e.converters[a];o=c.shift();while(o)if(e.responseFields[o]&&(n[e.responseFields[o]]=t),!u&&r&&e.dataFilter&&(t=e.dataFilter(t,e.dataType)),u=o,o=c.shift())if("*"===o)o=u;else if("*"!==u&&u!==o){if(!(a=l[u+" "+o]||l["* "+o]))for(i in l)if((s=i.split(" "))[1]===o&&(a=l[u+" "+s[0]]||l["* "+s[0]])){!0===a?a=l[i]:!0!==l[i]&&(o=s[0],c.unshift(s[1]));break}if(!0!==a)if(a&&e["throws"])t=a(t);else try{t=a(t)}catch(e){return{state:"parsererror",error:a?e:"No conversion from "+u+" to "+o}}}return{state:"success",data:t}}(v,s,T,i),i?(v.ifModified&&((u=T.getResponseHeader("Last-Modified"))&&(S.lastModified[f]=u),(u=T.getResponseHeader("etag"))&&(S.etag[f]=u)),204===e||"HEAD"===v.type?l="nocontent":304===e?l="notmodified":(l=s.state,o=s.data,i=!(a=s.error))):(a=l,!e&&l||(l="error",e<0&&(e=0))),T.status=e,T.statusText=(t||l)+"",i?x.resolveWith(y,[o,l,T]):x.rejectWith(y,[T,l,a]),T.statusCode(w),w=void 0,g&&m.trigger(i?"ajaxSuccess":"ajaxError",[T,v,i?o:a]),b.fireWith(y,[T,l]),g&&(m.trigger("ajaxComplete",[T,v]),--S.active||S.event.trigger("ajaxStop")))}return T},getJSON:function(e,t,n){return S.get(e,t,n,"json")},getScript:function(e,t){return S.get(e,void 0,t,"script")}}),S.each(["get","post"],function(e,i){S[i]=function(e,t,n,r){return m(t)&&(r=r||n,n=t,t=void 0),S.ajax(S.extend({url:e,type:i,dataType:r,data:t,success:n},S.isPlainObject(e)&&e))}}),S.ajaxPrefilter(function(e){var t;for(t in e.headers)"content-type"===t.toLowerCase()&&(e.contentType=e.headers[t]||"")}),S._evalUrl=function(e,t,n){return S.ajax({url:e,type:"GET",dataType:"script",cache:!0,async:!1,global:!1,converters:{"text script":function(){}},dataFilter:function(e){S.globalEval(e,t,n)}})},S.fn.extend({wrapAll:function(e){var t;return this[0]&&(m(e)&&(e=e.call(this[0])),t=S(e,this[0].ownerDocument).eq(0).clone(!0),this[0].parentNode&&t.insertBefore(this[0]),t.map(function(){var e=this;while(e.firstElementChild)e=e.firstElementChild;return e}).append(this)),this},wrapInner:function(n){return m(n)?this.each(function(e){S(this).wrapInner(n.call(this,e))}):this.each(function(){var e=S(this),t=e.contents();t.length?t.wrapAll(n):e.append(n)})},wrap:function(t){var n=m(t);return this.each(function(e){S(this).wrapAll(n?t.call(this,e):t)})},unwrap:function(e){return this.parent(e).not("body").each(function(){S(this).replaceWith(this.childNodes)}),this}}),S.expr.pseudos.hidden=function(e){return!S.expr.pseudos.visible(e)},S.expr.pseudos.visible=function(e){return!!(e.offsetWidth||e.offsetHeight||e.getClientRects().length)},S.ajaxSettings.xhr=function(){try{return new C.XMLHttpRequest}catch(e){}};var Bt={0:200,1223:204},$t=S.ajaxSettings.xhr();y.cors=!!$t&&"withCredentials"in $t,y.ajax=$t=!!$t,S.ajaxTransport(function(i){var o,a;if(y.cors||$t&&!i.crossDomain)return{send:function(e,t){var n,r=i.xhr();if(r.open(i.type,i.url,i.async,i.username,i.password),i.xhrFields)for(n in i.xhrFields)r[n]=i.xhrFields[n];for(n in i.mimeType&&r.overrideMimeType&&r.overrideMimeType(i.mimeType),i.crossDomain||e["X-Requested-With"]||(e["X-Requested-With"]="XMLHttpRequest"),e)r.setRequestHeader(n,e[n]);o=function(e){return function(){o&&(o=a=r.onload=r.onerror=r.onabort=r.ontimeout=r.onreadystatechange=null,"abort"===e?r.abort():"error"===e?"number"!=typeof r.status?t(0,"error"):t(r.status,r.statusText):t(Bt[r.status]||r.status,r.statusText,"text"!==(r.responseType||"text")||"string"!=typeof r.responseText?{binary:r.response}:{text:r.responseText},r.getAllResponseHeaders()))}},r.onload=o(),a=r.onerror=r.ontimeout=o("error"),void 0!==r.onabort?r.onabort=a:r.onreadystatechange=function(){4===r.readyState&&C.setTimeout(function(){o&&a()})},o=o("abort");try{r.send(i.hasContent&&i.data||null)}catch(e){if(o)throw e}},abort:function(){o&&o()}}}),S.ajaxPrefilter(function(e){e.crossDomain&&(e.contents.script=!1)}),S.ajaxSetup({accepts:{script:"text/javascript, application/javascript, application/ecmascript, application/x-ecmascript"},contents:{script:/\b(?:java|ecma)script\b/},converters:{"text script":function(e){return S.globalEval(e),e}}}),S.ajaxPrefilter("script",function(e){void 0===e.cache&&(e.cache=!1),e.crossDomain&&(e.type="GET")}),S.ajaxTransport("script",function(n){var r,i;if(n.crossDomain||n.scriptAttrs)return{send:function(e,t){r=S("<script>").attr(n.scriptAttrs||{}).prop({charset:n.scriptCharset,src:n.url}).on("load error",i=function(e){r.remove(),i=null,e&&t("error"===e.type?404:200,e.type)}),E.head.appendChild(r[0])},abort:function(){i&&i()}}});var _t,zt=[],Ut=/(=)\?(?=&|$)|\?\?/;S.ajaxSetup({jsonp:"callback",jsonpCallback:function(){var e=zt.pop()||S.expando+"_"+wt.guid++;return this[e]=!0,e}}),S.ajaxPrefilter("json jsonp",function(e,t,n){var r,i,o,a=!1!==e.jsonp&&(Ut.test(e.url)?"url":"string"==typeof e.data&&0===(e.contentType||"").indexOf("application/x-www-form-urlencoded")&&Ut.test(e.data)&&"data");if(a||"jsonp"===e.dataTypes[0])return r=e.jsonpCallback=m(e.jsonpCallback)?e.jsonpCallback():e.jsonpCallback,a?e[a]=e[a].replace(Ut,"$1"+r):!1!==e.jsonp&&(e.url+=(Tt.test(e.url)?"&":"?")+e.jsonp+"="+r),e.converters["script json"]=function(){return o||S.error(r+" was not called"),o[0]},e.dataTypes[0]="json",i=C[r],C[r]=function(){o=arguments},n.always(function(){void 0===i?S(C).removeProp(r):C[r]=i,e[r]&&(e.jsonpCallback=t.jsonpCallback,zt.push(r)),o&&m(i)&&i(o[0]),o=i=void 0}),"script"}),y.createHTMLDocument=((_t=E.implementation.createHTMLDocument("").body).innerHTML="<form></form><form></form>",2===_t.childNodes.length),S.parseHTML=function(e,t,n){return"string"!=typeof e?[]:("boolean"==typeof t&&(n=t,t=!1),t||(y.createHTMLDocument?((r=(t=E.implementation.createHTMLDocument("")).createElement("base")).href=E.location.href,t.head.appendChild(r)):t=E),o=!n&&[],(i=N.exec(e))?[t.createElement(i[1])]:(i=xe([e],t,o),o&&o.length&&S(o).remove(),S.merge([],i.childNodes)));var r,i,o},S.fn.load=function(e,t,n){var r,i,o,a=this,s=e.indexOf(" ");return-1<s&&(r=ht(e.slice(s)),e=e.slice(0,s)),m(t)?(n=t,t=void 0):t&&"object"==typeof t&&(i="POST"),0<a.length&&S.ajax({url:e,type:i||"GET",dataType:"html",data:t}).done(function(e){o=arguments,a.html(r?S("<div>").append(S.parseHTML(e)).find(r):e)}).always(n&&function(e,t){a.each(function(){n.apply(this,o||[e.responseText,t,e])})}),this},S.expr.pseudos.animated=function(t){return S.grep(S.timers,function(e){return t===e.elem}).length},S.offset={setOffset:function(e,t,n){var r,i,o,a,s,u,l=S.css(e,"position"),c=S(e),f={};"static"===l&&(e.style.position="relative"),s=c.offset(),o=S.css(e,"top"),u=S.css(e,"left"),("absolute"===l||"fixed"===l)&&-1<(o+u).indexOf("auto")?(a=(r=c.position()).top,i=r.left):(a=parseFloat(o)||0,i=parseFloat(u)||0),m(t)&&(t=t.call(e,n,S.extend({},s))),null!=t.top&&(f.top=t.top-s.top+a),null!=t.left&&(f.left=t.left-s.left+i),"using"in t?t.using.call(e,f):c.css(f)}},S.fn.extend({offset:function(t){if(arguments.length)return void 0===t?this:this.each(function(e){S.offset.setOffset(this,t,e)});var e,n,r=this[0];return r?r.getClientRects().length?(e=r.getBoundingClientRect(),n=r.ownerDocument.defaultView,{top:e.top+n.pageYOffset,left:e.left+n.pageXOffset}):{top:0,left:0}:void 0},position:function(){if(this[0]){var e,t,n,r=this[0],i={top:0,left:0};if("fixed"===S.css(r,"position"))t=r.getBoundingClientRect();else{t=this.offset(),n=r.ownerDocument,e=r.offsetParent||n.documentElement;while(e&&(e===n.body||e===n.documentElement)&&"static"===S.css(e,"position"))e=e.parentNode;e&&e!==r&&1===e.nodeType&&((i=S(e).offset()).top+=S.css(e,"borderTopWidth",!0),i.left+=S.css(e,"borderLeftWidth",!0))}return{top:t.top-i.top-S.css(r,"marginTop",!0),left:t.left-i.left-S.css(r,"marginLeft",!0)}}},offsetParent:function(){return this.map(function(){var e=this.offsetParent;while(e&&"static"===S.css(e,"position"))e=e.offsetParent;return e||re})}}),S.each({scrollLeft:"pageXOffset",scrollTop:"pageYOffset"},function(t,i){var o="pageYOffset"===i;S.fn[t]=function(e){return $(this,function(e,t,n){var r;if(x(e)?r=e:9===e.nodeType&&(r=e.defaultView),void 0===n)return r?r[i]:e[t];r?r.scrollTo(o?r.pageXOffset:n,o?n:r.pageYOffset):e[t]=n},t,e,arguments.length)}}),S.each(["top","left"],function(e,n){S.cssHooks[n]=Fe(y.pixelPosition,function(e,t){if(t)return t=We(e,n),Pe.test(t)?S(e).position()[n]+"px":t})}),S.each({Height:"height",Width:"width"},function(a,s){S.each({padding:"inner"+a,content:s,"":"outer"+a},function(r,o){S.fn[o]=function(e,t){var n=arguments.length&&(r||"boolean"!=typeof e),i=r||(!0===e||!0===t?"margin":"border");return $(this,function(e,t,n){var r;return x(e)?0===o.indexOf("outer")?e["inner"+a]:e.document.documentElement["client"+a]:9===e.nodeType?(r=e.documentElement,Math.max(e.body["scroll"+a],r["scroll"+a],e.body["offset"+a],r["offset"+a],r["client"+a])):void 0===n?S.css(e,t,i):S.style(e,t,n,i)},s,n?e:void 0,n)}})}),S.each(["ajaxStart","ajaxStop","ajaxComplete","ajaxError","ajaxSuccess","ajaxSend"],function(e,t){S.fn[t]=function(e){return this.on(t,e)}}),S.fn.extend({bind:function(e,t,n){return this.on(e,null,t,n)},unbind:function(e,t){return this.off(e,null,t)},delegate:function(e,t,n,r){return this.on(t,e,n,r)},undelegate:function(e,t,n){return 1===arguments.length?this.off(e,"**"):this.off(t,e||"**",n)},hover:function(e,t){return this.mouseenter(e).mouseleave(t||e)}}),S.each("blur focus focusin focusout resize scroll click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup contextmenu".split(" "),function(e,n){S.fn[n]=function(e,t){return 0<arguments.length?this.on(n,null,e,t):this.trigger(n)}});var Xt=/^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g;S.proxy=function(e,t){var n,r,i;if("string"==typeof t&&(n=e[t],t=e,e=n),m(e))return r=s.call(arguments,2),(i=function(){return e.apply(t||this,r.concat(s.call(arguments)))}).guid=e.guid=e.guid||S.guid++,i},S.holdReady=function(e){e?S.readyWait++:S.ready(!0)},S.isArray=Array.isArray,S.parseJSON=JSON.parse,S.nodeName=A,S.isFunction=m,S.isWindow=x,S.camelCase=X,S.type=w,S.now=Date.now,S.isNumeric=function(e){var t=S.type(e);return("number"===t||"string"===t)&&!isNaN(e-parseFloat(e))},S.trim=function(e){return null==e?"":(e+"").replace(Xt,"")},"function"==typeof define&&define.amd&&define("jquery",[],function(){return S});var Vt=C.jQuery,Gt=C.$;return S.noConflict=function(e){return C.$===S&&(C.$=Gt),e&&C.jQuery===S&&(C.jQuery=Vt),S},"undefined"==typeof e&&(C.jQuery=C.$=S),S});

// Utility function
function Util () {};

/* 
	class manipulation functions
*/
Util.hasClass = function(el, className) {
	return el.classList.contains(className);
};

Util.addClass = function(el, className) {
	var classList = className.split(' ');
 	el.classList.add(classList[0]);
 	if (classList.length > 1) Util.addClass(el, classList.slice(1).join(' '));
};

Util.removeClass = function(el, className) {
	var classList = className.split(' ');
	el.classList.remove(classList[0]);	
	if (classList.length > 1) Util.removeClass(el, classList.slice(1).join(' '));
};

Util.toggleClass = function(el, className, bool) {
	if(bool) Util.addClass(el, className);
	else Util.removeClass(el, className);
};

Util.setAttributes = function(el, attrs) {
  for(var key in attrs) {
    el.setAttribute(key, attrs[key]);
  }
};

/* 
  DOM manipulation
*/
Util.getChildrenByClassName = function(el, className) {
  var children = el.children,
    childrenByClass = [];
  for (var i = 0; i < children.length; i++) {
    if (Util.hasClass(children[i], className)) childrenByClass.push(children[i]);
  }
  return childrenByClass;
};

Util.is = function(elem, selector) {
  if(selector.nodeType){
    return elem === selector;
  }

  var qa = (typeof(selector) === 'string' ? document.querySelectorAll(selector) : selector),
    length = qa.length,
    returnArr = [];

  while(length--){
    if(qa[length] === elem){
      return true;
    }
  }

  return false;
};

/* 
	Animate height of an element
*/
Util.setHeight = function(start, to, element, duration, cb, timeFunction) {
	var change = to - start,
	    currentTime = null;

  var animateHeight = function(timestamp){  
    if (!currentTime) currentTime = timestamp;         
    var progress = timestamp - currentTime;
    if(progress > duration) progress = duration;
    var val = parseInt((progress/duration)*change + start);
    if(timeFunction) {
      val = Math[timeFunction](progress, start, to - start, duration);
    }
    element.style.height = val+"px";
    if(progress < duration) {
        window.requestAnimationFrame(animateHeight);
    } else {
    	if(cb) cb();
    }
  };
  
  //set the height of the element before starting animation -> fix bug on Safari
  element.style.height = start+"px";
  window.requestAnimationFrame(animateHeight);
};

/* 
	Smooth Scroll
*/

Util.scrollTo = function(final, duration, cb, scrollEl) {
  var element = scrollEl || window;
  var start = element.scrollTop || document.documentElement.scrollTop,
    currentTime = null;

  if(!scrollEl) start = window.scrollY || document.documentElement.scrollTop;
      
  var animateScroll = function(timestamp){
  	if (!currentTime) currentTime = timestamp;        
    var progress = timestamp - currentTime;
    if(progress > duration) progress = duration;
    var val = Math.easeInOutQuad(progress, start, final-start, duration);
    element.scrollTo(0, val);
    if(progress < duration) {
      window.requestAnimationFrame(animateScroll);
    } else {
      cb && cb();
    }
  };

  window.requestAnimationFrame(animateScroll);
};

/* 
  Focus utility classes
*/

//Move focus to an element
Util.moveFocus = function (element) {
  if( !element ) element = document.getElementsByTagName("body")[0];
  element.focus();
  if (document.activeElement !== element) {
    element.setAttribute('tabindex','-1');
    element.focus();
  }
};

/* 
  Misc
*/

Util.getIndexInArray = function(array, el) {
  return Array.prototype.indexOf.call(array, el);
};

Util.cssSupports = function(property, value) {
  if('CSS' in window) {
    return CSS.supports(property, value);
  } else {
    var jsProperty = property.replace(/-([a-z])/g, function (g) { return g[1].toUpperCase();});
    return jsProperty in document.body.style;
  }
};

// merge a set of user options into plugin defaults
// https://gomakethings.com/vanilla-javascript-version-of-jquery-extend/
Util.extend = function() {
  // Variables
  var extended = {};
  var deep = false;
  var i = 0;
  var length = arguments.length;

  // Check if a deep merge
  if ( Object.prototype.toString.call( arguments[0] ) === '[object Boolean]' ) {
    deep = arguments[0];
    i++;
  }

  // Merge the object into the extended object
  var merge = function (obj) {
    for ( var prop in obj ) {
      if ( Object.prototype.hasOwnProperty.call( obj, prop ) ) {
        // If deep merge and property is an object, merge properties
        if ( deep && Object.prototype.toString.call(obj[prop]) === '[object Object]' ) {
          extended[prop] = extend( true, extended[prop], obj[prop] );
        } else {
          extended[prop] = obj[prop];
        }
      }
    }
  };

  // Loop through each object and conduct a merge
  for ( ; i < length; i++ ) {
    var obj = arguments[i];
    merge(obj);
  }

  return extended;
};

// Check if Reduced Motion is enabled
Util.osHasReducedMotion = function() {
  if(!window.matchMedia) return false;
  var matchMediaObj = window.matchMedia('(prefers-reduced-motion: reduce)');
  if(matchMediaObj) return matchMediaObj.matches;
  return false; // return false if not supported
}; 

/* 
	Polyfills
*/
//Closest() method
if (!Element.prototype.matches) {
	Element.prototype.matches = Element.prototype.msMatchesSelector || Element.prototype.webkitMatchesSelector;
}

if (!Element.prototype.closest) {
	Element.prototype.closest = function(s) {
		var el = this;
		if (!document.documentElement.contains(el)) return null;
		do {
			if (el.matches(s)) return el;
			el = el.parentElement || el.parentNode;
		} while (el !== null && el.nodeType === 1); 
		return null;
	};
}

//Custom Event() constructor
if ( typeof window.CustomEvent !== "function" ) {

  function CustomEvent ( event, params ) {
    params = params || { bubbles: false, cancelable: false, detail: undefined };
    var evt = document.createEvent( 'CustomEvent' );
    evt.initCustomEvent( event, params.bubbles, params.cancelable, params.detail );
    return evt;
   }

  CustomEvent.prototype = window.Event.prototype;

  window.CustomEvent = CustomEvent;
}

/* 
	Animation curves
*/
Math.easeInOutQuad = function (t, b, c, d) {
	t /= d/2;
	if (t < 1) return c/2*t*t + b;
	t--;
	return -c/2 * (t*(t-2) - 1) + b;
};

Math.easeInQuart = function (t, b, c, d) {
	t /= d;
	return c*t*t*t*t + b;
};

Math.easeOutQuart = function (t, b, c, d) { 
  t /= d;
	t--;
	return -c * (t*t*t*t - 1) + b;
};

Math.easeInOutQuart = function (t, b, c, d) {
	t /= d/2;
	if (t < 1) return c/2*t*t*t*t + b;
	t -= 2;
	return -c/2 * (t*t*t*t - 2) + b;
};

Math.easeOutElastic = function (t, b, c, d) {
  var s=1.70158;var p=d*0.7;var a=c;
  if (t==0) return b;  if ((t/=d)==1) return b+c;  if (!p) p=d*.3;
  if (a < Math.abs(c)) { a=c; var s=p/4; }
  else var s = p/(2*Math.PI) * Math.asin (c/a);
  return a*Math.pow(2,-10*t) * Math.sin( (t*d-s)*(2*Math.PI)/p ) + c + b;
};


/* JS Utility Classes */

// make focus ring visible only for keyboard navigation (i.e., tab key) 
(function() {
  var focusTab = document.getElementsByClassName('js-tab-focus'),
    shouldInit = false,
    outlineStyle = false,
    eventDetected = false;

  function detectClick() {
    if(focusTab.length > 0) {
      resetFocusStyle(false);
      window.addEventListener('keydown', detectTab);
    }
    window.removeEventListener('mousedown', detectClick);
    outlineStyle = false;
    eventDetected = true;
  };

  function detectTab(event) {
    if(event.keyCode !== 9) return;
    resetFocusStyle(true);
    window.removeEventListener('keydown', detectTab);
    window.addEventListener('mousedown', detectClick);
    outlineStyle = true;
  };

  function resetFocusStyle(bool) {
    var outlineStyle = bool ? '' : 'none';
    for(var i = 0; i < focusTab.length; i++) {
      focusTab[i].style.setProperty('outline', outlineStyle);
    }
  };

  function initFocusTabs() {
    if(shouldInit) {
      if(eventDetected) resetFocusStyle(outlineStyle);
      return;
    }
    shouldInit = focusTab.length > 0;
    window.addEventListener('mousedown', detectClick);
  };

  initFocusTabs();
  window.addEventListener('initFocusTabs', initFocusTabs);
}());

function resetFocusTabsStyle() {
  window.dispatchEvent(new CustomEvent('initFocusTabs'));
};
(function() {
    $('.img-blend').each(function(){
        const pattern = $(this).attr('data-blend-pattern').split(',')
        let color = $(this).attr('data-blend-color');

        // Default color if this option does not exit in element;
        /*
        * Colors by CodyHouse
        * */
        //--color-bg-darker
        //--color-bg-dark
        //--color-bg
        //--color-bg-light
        //--color-bg-lighter

        // Default color;
        if(color === undefined){
            color = '--color-bg-light';
        }

        for(let i = 0 ; i < pattern.length ; i++){
            if(parseInt(pattern[i]) !== 1){
                continue
            }

            switch(i){
                case 0:
                    $(this).append('<div class="img-blend-top"></div>')
                    $(this).children('.img-blend-top').css('background-image', 'linear-gradient(180deg, var(' + color + ') 20px, transparent)')
                    break

                case 1:
                    $(this).append('<div class="img-blend-right"></div>')
                    $(this).children('.img-blend-right').css('background-image', 'linear-gradient(270deg, var(' + color + ') 20px, transparent)')
                    break

                case 2:
                    $(this).append('<div class="img-blend-bottom"></div>')
                    $(this).children('.img-blend-bottom').css('background-image', 'linear-gradient(0deg, var(' + color + ') 20px, transparent)')
                    break

                case 3:
                    $(this).append('<div class="img-blend-left"></div>')
                    $(this).children('.img-blend-left').css('background-image', 'linear-gradient(90deg, var(' + color + ') 20px, transparent)')
                    break
            }
        }
    })
}());
// File#: _1_modal-window
// Usage: codyhouse.co/license
(function() {
  var Modal = function(element) {
      this.element = element;
      this.triggers = document.querySelectorAll('[aria-controls="'+this.element.getAttribute('id')+'"]');
      this.firstFocusable = null;
      this.lastFocusable = null;
      this.moveFocusEl = null; // focus will be moved to this element when modal is open
      this.modalFocus = this.element.getAttribute('data-modal-first-focus') ? this.element.querySelector(this.element.getAttribute('data-modal-first-focus')) : null;
      this.selectedTrigger = null;
      this.preventScrollEl = this.getPreventScrollEl();
      this.showClass = "modal--is-visible";
      this.initModal();
  };

  Modal.prototype.getPreventScrollEl = function() {
      var scrollEl = false;
      var querySelector = this.element.getAttribute('data-modal-prevent-scroll');
      if(querySelector) scrollEl = document.querySelector(querySelector);
      return scrollEl;
  };

  Modal.prototype.initModal = function() {
      var self = this;
      //open modal when clicking on trigger buttons
      if ( this.triggers ) {
          for(var i = 0; i < this.triggers.length; i++) {
              this.triggers[i].addEventListener('click', function(event) {
                  event.preventDefault();
                  if(Util.hasClass(self.element, self.showClass)) {
                      self.closeModal();
                      return;
                  }
                  self.selectedTrigger = event.target;
                  self.showModal();
                  self.initModalEvents();
              });
          }
      }

      // listen to the openModal event -> open modal without a trigger button
      this.element.addEventListener('openModal', function(event){
          if(event.detail) self.selectedTrigger = event.detail;
          self.showModal();
          self.initModalEvents();
      });

      // listen to the closeModal event -> close modal without a trigger button
      this.element.addEventListener('closeModal', function(event){
          if(event.detail) self.selectedTrigger = event.detail;
          self.closeModal();
      });

      // if modal is open by default -> initialise modal events
      if(Util.hasClass(this.element, this.showClass)) this.initModalEvents();
  };

  Modal.prototype.showModal = function() {
      // Remove visible class from all visible modals, because modals;
      // Logically - it is incorrect to display several modal windows at the same time;
      var modals = document.getElementsByClassName('js-modal');
      if( modals.length > 0 ) {
          for( var i = 0; i < modals.length; i++) {
              (function(i){
                  modals[i].classList.remove("modal--is-visible");
              })(i);
          }
      }

      var self = this;
      Util.addClass(this.element, this.showClass);
      this.getFocusableElements();
      if(this.moveFocusEl) {
          this.moveFocusEl.focus();
          // wait for the end of transitions before moving focus
          this.element.addEventListener("transitionend", function cb(event) {
              self.moveFocusEl.focus();
              self.element.removeEventListener("transitionend", cb);
          });
      }
      this.emitModalEvents('modalIsOpen');
      // change the overflow of the preventScrollEl
      if(this.preventScrollEl) this.preventScrollEl.style.overflow = 'hidden';
  };

  Modal.prototype.closeModal = function() {
      if(!Util.hasClass(this.element, this.showClass)) return;
      console.log('close')
      Util.removeClass(this.element, this.showClass);
      this.firstFocusable = null;
      this.lastFocusable = null;
      this.moveFocusEl = null;
      if(this.selectedTrigger) this.selectedTrigger.focus();
      //remove listeners
      this.cancelModalEvents();
      this.emitModalEvents('modalIsClose');
      // change the overflow of the preventScrollEl
      if(this.preventScrollEl) this.preventScrollEl.style.overflow = '';
  };

  Modal.prototype.initModalEvents = function() {
      //add event listeners
      this.element.addEventListener('keydown', this);
      this.element.addEventListener('click', this);
  };

  Modal.prototype.cancelModalEvents = function() {
      //remove event listeners
      this.element.removeEventListener('keydown', this);
      this.element.removeEventListener('click', this);
  };

  Modal.prototype.handleEvent = function (event) {
      switch(event.type) {
          case 'click': {
              this.initClick(event);
          }
          case 'keydown': {
              this.initKeyDown(event);
          }
      }
  };

  Modal.prototype.initKeyDown = function(event) {
      if( event.keyCode && event.keyCode == 9 || event.key && event.key == 'Tab' ) {
          //trap focus inside modal
          this.trapFocus(event);
      } else if( (event.keyCode && event.keyCode == 13 || event.key && event.key == 'Enter') && event.target.closest('.js-modal__close')) {
          event.preventDefault();
          this.closeModal(); // close modal when pressing Enter on close button
      }
  };

  Modal.prototype.initClick = function(event) {
      //close modal when clicking on close button or modal bg layer
      if( !event.target.closest('.js-modal__close') && !Util.hasClass(event.target, 'js-modal') ) return;
      event.preventDefault();
      this.closeModal();
  };

  Modal.prototype.trapFocus = function(event) {
      if( this.firstFocusable == document.activeElement && event.shiftKey) {
          //on Shift+Tab -> focus last focusable element when focus moves out of modal
          event.preventDefault();
          this.lastFocusable.focus();
      }
      if( this.lastFocusable == document.activeElement && !event.shiftKey) {
          //on Tab -> focus first focusable element when focus moves out of modal
          event.preventDefault();
          this.firstFocusable.focus();
      }
  }

  Modal.prototype.getFocusableElements = function() {
      //get all focusable elements inside the modal
      var allFocusable = this.element.querySelectorAll(focusableElString);
      this.getFirstVisible(allFocusable);
      this.getLastVisible(allFocusable);
      this.getFirstFocusable();
  };

  Modal.prototype.getFirstVisible = function(elements) {
      //get first visible focusable element inside the modal
      for(var i = 0; i < elements.length; i++) {
          if( isVisible(elements[i]) ) {
              this.firstFocusable = elements[i];
              break;
          }
      }
  };

  Modal.prototype.getLastVisible = function(elements) {
      //get last visible focusable element inside the modal
      for(var i = elements.length - 1; i >= 0; i--) {
          if( isVisible(elements[i]) ) {
              this.lastFocusable = elements[i];
              break;
          }
      }
  };

  Modal.prototype.getFirstFocusable = function() {
      if(!this.modalFocus || !Element.prototype.matches) {
          this.moveFocusEl = this.firstFocusable;
          return;
      }
      var containerIsFocusable = this.modalFocus.matches(focusableElString);
      if(containerIsFocusable) {
          this.moveFocusEl = this.modalFocus;
      } else {
          this.moveFocusEl = false;
          var elements = this.modalFocus.querySelectorAll(focusableElString);
          for(var i = 0; i < elements.length; i++) {
              if( isVisible(elements[i]) ) {
                  this.moveFocusEl = elements[i];
                  break;
              }
          }
          if(!this.moveFocusEl) this.moveFocusEl = this.firstFocusable;
      }
  };

  Modal.prototype.emitModalEvents = function(eventName) {
      var event = new CustomEvent(eventName, {detail: this.selectedTrigger});
      this.element.dispatchEvent(event);
  };

  function isVisible(element) {
      return element.offsetWidth || element.offsetHeight || element.getClientRects().length;
  };

  window.Modal = Modal;

  //initialize the Modal objects
  var modals = document.getElementsByClassName('js-modal');
  // generic focusable elements string selector
  var focusableElString = '[href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), button:not([disabled]), iframe, object, embed, [tabindex]:not([tabindex="-1"]), [contenteditable], audio[controls], video[controls], summary';
  if( modals.length > 0 ) {
      var modalArrays = [];
      for( var i = 0; i < modals.length; i++) {
          (function(i){modalArrays.push(new Modal(modals[i]));})(i);
      }

      window.addEventListener('keydown', function(event){ //close modal window on esc
          if(event.keyCode && event.keyCode == 27 || event.key && event.key.toLowerCase() == 'escape') {
              for( var i = 0; i < modalArrays.length; i++) {
                  (function(i){modalArrays[i].closeModal();})(i);
              };
          }
      });
  }
}());
// File#: _1_accordion
// Usage: codyhouse.co/license
(function() {
    var Accordion = function(element) {
      this.element = element;
      this.items = Util.getChildrenByClassName(this.element, 'js-accordion__item');
      this.version = this.element.getAttribute('data-version') ? '-'+this.element.getAttribute('data-version') : '';
      this.showClass = 'accordion'+this.version+'__item--is-open';
      this.animateHeight = (this.element.getAttribute('data-animation') == 'on');
      this.multiItems = !(this.element.getAttribute('data-multi-items') == 'off'); 
      // deep linking options
      this.deepLinkOn = this.element.getAttribute('data-deep-link') == 'on';
      // init accordion
      this.initAccordion();
    };
  
    Accordion.prototype.initAccordion = function() {
      //set initial aria attributes
      for( var i = 0; i < this.items.length; i++) {
        var button = this.items[i].getElementsByTagName('button')[0],
          content = this.items[i].getElementsByClassName('js-accordion__panel')[0],
          isOpen = Util.hasClass(this.items[i], this.showClass) ? 'true' : 'false';
        Util.setAttributes(button, {'aria-expanded': isOpen, 'aria-controls': 'accordion-content-'+i, 'id': 'accordion-header-'+i});
        Util.addClass(button, 'js-accordion__trigger');
        Util.setAttributes(content, {'aria-labelledby': 'accordion-header-'+i, 'id': 'accordion-content-'+i});
      }
  
      //listen for Accordion events
      this.initAccordionEvents();
  
      // check deep linking option
      this.initDeepLink();
    };
  
    Accordion.prototype.initAccordionEvents = function() {
      var self = this;
  
      this.element.addEventListener('click', function(event) {
        var trigger = event.target.closest('.js-accordion__trigger');
        //check index to make sure the click didn't happen inside a children accordion
        if( trigger && Util.getIndexInArray(self.items, trigger.parentElement) >= 0) self.triggerAccordion(trigger);
      });
    };
  
    Accordion.prototype.triggerAccordion = function(trigger) {
      var bool = (trigger.getAttribute('aria-expanded') === 'true');
  
      this.animateAccordion(trigger, bool, false);
  
      if(!bool && this.deepLinkOn) {
        history.replaceState(null, '', '#'+trigger.getAttribute('aria-controls'));
      }
    };
  
    Accordion.prototype.animateAccordion = function(trigger, bool, deepLink) {
      var self = this;
      var item = trigger.closest('.js-accordion__item'),
        content = item.getElementsByClassName('js-accordion__panel')[0],
        ariaValue = bool ? 'false' : 'true';
  
      if(!bool) Util.addClass(item, this.showClass);
      trigger.setAttribute('aria-expanded', ariaValue);
      self.resetContentVisibility(item, content, bool);
  
      if( !this.multiItems && !bool || deepLink) this.closeSiblings(item);
    };
  
    Accordion.prototype.resetContentVisibility = function(item, content, bool) {
      Util.toggleClass(item, this.showClass, !bool);
      content.removeAttribute("style");
      if(bool && !this.multiItems) { // accordion item has been closed -> check if there's one open to move inside viewport 
        this.moveContent();
      }
    };
  
    Accordion.prototype.closeSiblings = function(item) {
      //if only one accordion can be open -> search if there's another one open
      var index = Util.getIndexInArray(this.items, item);
      for( var i = 0; i < this.items.length; i++) {
        if(Util.hasClass(this.items[i], this.showClass) && i != index) {
          this.animateAccordion(this.items[i].getElementsByClassName('js-accordion__trigger')[0], true, false);
          return false;
        }
      }
    };
  
    Accordion.prototype.moveContent = function() { // make sure title of the accordion just opened is inside the viewport
      var openAccordion = this.element.getElementsByClassName(this.showClass);
      if(openAccordion.length == 0) return;
      var boundingRect = openAccordion[0].getBoundingClientRect();
      if(boundingRect.top < 0 || boundingRect.top > window.innerHeight) {
        var windowScrollTop = window.scrollY || document.documentElement.scrollTop;
        window.scrollTo(0, boundingRect.top + windowScrollTop);
      }
    };
  
    Accordion.prototype.initDeepLink = function() {
      if(!this.deepLinkOn) return;
      var hash = window.location.hash.substr(1);
      if(!hash || hash == '') return;
      var trigger = this.element.querySelector('.js-accordion__trigger[aria-controls="'+hash+'"]');
      if(trigger && trigger.getAttribute('aria-expanded') !== 'true') {
        this.animateAccordion(trigger, false, true);
        setTimeout(function(){trigger.scrollIntoView(true);});
      }
    };
  
    window.Accordion = Accordion;
    
    //initialize the Accordion objects
    var accordions = document.getElementsByClassName('js-accordion');
    if( accordions.length > 0 ) {
      for( var i = 0; i < accordions.length; i++) {
        (function(i){new Accordion(accordions[i]);})(i);
      }
    }
  }());
// File#: _1_anim-menu-btn
// Usage: codyhouse.co/license
(function() {
    var menuBtns = document.getElementsByClassName('js-anim-menu-btn');
    if( menuBtns.length > 0 ) {
      for(var i = 0; i < menuBtns.length; i++) {(function(i){
        initMenuBtn(menuBtns[i]);
      })(i);}
  
      function initMenuBtn(btn) {
        btn.addEventListener('click', function(event){	
          event.preventDefault();
          var status = !Util.hasClass(btn, 'anim-menu-btn--state-b');
          Util.toggleClass(btn, 'anim-menu-btn--state-b', status);
          // emit custom event
          var event = new CustomEvent('anim-menu-btn-clicked', {detail: status});
          btn.dispatchEvent(event);
        });
      };
    }
  }());
// File#: _1_choice-tags
// Usage: codyhouse.co/license
(function() {
    var ChoiceTags = function(element) {
      this.element = element;
      this.labels = this.element.getElementsByClassName('js-choice-tag');
      this.inputs = getChoiceInput(this);
      this.isRadio = this.inputs[0].type.toString() == 'radio';
      this.checkedClass = 'choice-tag--checked';
      initChoiceTags(this);
      initChoiceTagEvent(this);
    }
  
    function getChoiceInput(element) {
      var inputs = [];
      for(var i = 0; i < element.labels.length; i++) {
        inputs.push(element.labels[i].getElementsByTagName('input')[0]);
      }
      return inputs;
    };
  
    function initChoiceTags(element) {
      // if tag is selected by default - add checkedClass to the label element
      for(var i = 0; i < element.inputs.length; i++) {
        Util.toggleClass(element.labels[i], element.checkedClass, element.inputs[i].checked);
      }
    };
  
    function initChoiceTagEvent(element) {
      element.element.addEventListener('change', function(event) {
        var inputIndex = Util.getIndexInArray(element.inputs, event.target);
        if(inputIndex < 0) return;
        Util.toggleClass(element.labels[inputIndex], element.checkedClass, event.target.checked);
        if(element.isRadio && event.target.checked) resetRadioTags(element, inputIndex);
      });
    };
  
    function resetRadioTags(element, index) {
      // when a radio input is checked - reset all the others
      for(var i = 0; i < element.labels.length; i++) {
        if(i != index) Util.removeClass(element.labels[i], element.checkedClass);
      }
    };
  
    //initialize the ChoiceTags objects
    var choiceTags = document.getElementsByClassName('js-choice-tags');
    if( choiceTags.length > 0 ) {
      for( var i = 0; i < choiceTags.length; i++) {
        (function(i){new ChoiceTags(choiceTags[i]);})(i);
      }
    };
  }());
// File#: _1_details
// Usage: codyhouse.co/license
(function() {
    var Details = function(element, index) {
      this.element = element;
      this.summary = this.element.getElementsByClassName('js-details__summary')[0];
      this.details = this.element.getElementsByClassName('js-details__content')[0];
      this.htmlElSupported = 'open' in this.element;
      this.initDetails(index);
      this.initDetailsEvents();
    };
  
    Details.prototype.initDetails = function(index) {
      // init aria attributes 
      Util.setAttributes(this.summary, {'aria-expanded': 'false', 'aria-controls': 'details--'+index, 'role': 'button'});
      Util.setAttributes(this.details, {'aria-hidden': 'true', 'id': 'details--'+index});
    };
  
    Details.prototype.initDetailsEvents = function() {
      var self = this;
      if( this.htmlElSupported ) { // browser supports the <details> element 
        this.element.addEventListener('toggle', function(event){
          var ariaValues = self.element.open ? ['true', 'false'] : ['false', 'true'];
          // update aria attributes when details element status change (open/close)
          self.updateAriaValues(ariaValues);
        });
      } else { //browser does not support <details>
        this.summary.addEventListener('click', function(event){
          event.preventDefault();
          var isOpen = self.element.getAttribute('open'),
            ariaValues = [];
  
          isOpen ? self.element.removeAttribute('open') : self.element.setAttribute('open', 'true');
          ariaValues = isOpen ? ['false', 'true'] : ['true', 'false'];
          self.updateAriaValues(ariaValues);
        });
      }
    };
  
    Details.prototype.updateAriaValues = function(values) {
      this.summary.setAttribute('aria-expanded', values[0]);
      this.details.setAttribute('aria-hidden', values[1]);
    };
  
    //initialize the Details objects
    var detailsEl = document.getElementsByClassName('js-details');
    if( detailsEl.length > 0 ) {
      for( var i = 0; i < detailsEl.length; i++) {
        (function(i){new Details(detailsEl[i], i);})(i);
      }
    }
  }());
// File#: _1_diagonal-movement
// Usage: codyhouse.co/license
/*
  Modified version of the jQuery-menu-aim plugin
  https://github.com/kamens/jQuery-menu-aim
  - Replaced jQuery with Vanilla JS
  - Minor changes
*/
(function() {
    var menuAim = function(opts) {
      init(opts);
    };
  
    window.menuAim = menuAim;
  
    function init(opts) {
      var activeRow = null,
        mouseLocs = [],
        lastDelayLoc = null,
        timeoutId = null,
        options = Util.extend({
          menu: '',
          rows: false, //if false, get direct children - otherwise pass nodes list 
          submenuSelector: "*",
          submenuDirection: "right",
          tolerance: 75,  // bigger = more forgivey when entering submenu
          enter: function(){},
          exit: function(){},
          activate: function(){},
          deactivate: function(){},
          exitMenu: function(){}
        }, opts),
        menu = options.menu;
  
      var MOUSE_LOCS_TRACKED = 3,  // number of past mouse locations to track
        DELAY = 300;  // ms delay when user appears to be entering submenu
  
      /**
       * Keep track of the last few locations of the mouse.
       */
      var mouseMoveFallback = function(event) {
        (!window.requestAnimationFrame) ? mousemoveDocument(event) : window.requestAnimationFrame(function(){mousemoveDocument(event);});
      };
  
      var mousemoveDocument = function(e) {
        mouseLocs.push({x: e.pageX, y: e.pageY});
  
        if (mouseLocs.length > MOUSE_LOCS_TRACKED) {
          mouseLocs.shift();
        }
      };
  
      /**
       * Cancel possible row activations when leaving the menu entirely
       */
      var mouseleaveMenu = function() {
        if (timeoutId) {
          clearTimeout(timeoutId);
        }
  
        // If exitMenu is supplied and returns true, deactivate the
        // currently active row on menu exit.
        if (options.exitMenu(this)) {
          if (activeRow) {
            options.deactivate(activeRow);
          }
  
          activeRow = null;
        }
      };
  
      /**
       * Trigger a possible row activation whenever entering a new row.
       */
      var mouseenterRow = function() {
        if (timeoutId) {
          // Cancel any previous activation delays
          clearTimeout(timeoutId);
        }
  
        options.enter(this);
        possiblyActivate(this);
      },
      mouseleaveRow = function() {
        options.exit(this);
      };
  
      /*
       * Immediately activate a row if the user clicks on it.
       */
      var clickRow = function() {
        activate(this);
      };  
  
      /**
       * Activate a menu row.
       */
      var activate = function(row) {
        if (row == activeRow) {
          return;
        }
  
        if (activeRow) {
          options.deactivate(activeRow);
        }
  
        options.activate(row);
        activeRow = row;
      };
  
      /**
       * Possibly activate a menu row. If mouse movement indicates that we
       * shouldn't activate yet because user may be trying to enter
       * a submenu's content, then delay and check again later.
       */
      var possiblyActivate = function(row) {
        var delay = activationDelay();
  
        if (delay) {
          timeoutId = setTimeout(function() {
            possiblyActivate(row);
          }, delay);
        } else {
          activate(row);
        }
      };
  
      /**
       * Return the amount of time that should be used as a delay before the
       * currently hovered row is activated.
       *
       * Returns 0 if the activation should happen immediately. Otherwise,
       * returns the number of milliseconds that should be delayed before
       * checking again to see if the row should be activated.
       */
      var activationDelay = function() {
        if (!activeRow || !Util.is(activeRow, options.submenuSelector)) {
          // If there is no other submenu row already active, then
          // go ahead and activate immediately.
          return 0;
        }
  
        function getOffset(element) {
          var rect = element.getBoundingClientRect();
          return { top: rect.top + window.pageYOffset, left: rect.left + window.pageXOffset };
        };
  
        var offset = getOffset(menu),
            upperLeft = {
                x: offset.left,
                y: offset.top - options.tolerance
            },
            upperRight = {
                x: offset.left + menu.offsetWidth,
                y: upperLeft.y
            },
            lowerLeft = {
                x: offset.left,
                y: offset.top + menu.offsetHeight + options.tolerance
            },
            lowerRight = {
                x: offset.left + menu.offsetWidth,
                y: lowerLeft.y
            },
            loc = mouseLocs[mouseLocs.length - 1],
            prevLoc = mouseLocs[0];
  
        if (!loc) {
          return 0;
        }
  
        if (!prevLoc) {
          prevLoc = loc;
        }
  
        if (prevLoc.x < offset.left || prevLoc.x > lowerRight.x || prevLoc.y < offset.top || prevLoc.y > lowerRight.y) {
          // If the previous mouse location was outside of the entire
          // menu's bounds, immediately activate.
          return 0;
        }
  
        if (lastDelayLoc && loc.x == lastDelayLoc.x && loc.y == lastDelayLoc.y) {
          // If the mouse hasn't moved since the last time we checked
          // for activation status, immediately activate.
          return 0;
        }
  
        // Detect if the user is moving towards the currently activated
        // submenu.
        //
        // If the mouse is heading relatively clearly towards
        // the submenu's content, we should wait and give the user more
        // time before activating a new row. If the mouse is heading
        // elsewhere, we can immediately activate a new row.
        //
        // We detect this by calculating the slope formed between the
        // current mouse location and the upper/lower right points of
        // the menu. We do the same for the previous mouse location.
        // If the current mouse location's slopes are
        // increasing/decreasing appropriately compared to the
        // previous's, we know the user is moving toward the submenu.
        //
        // Note that since the y-axis increases as the cursor moves
        // down the screen, we are looking for the slope between the
        // cursor and the upper right corner to decrease over time, not
        // increase (somewhat counterintuitively).
        function slope(a, b) {
          return (b.y - a.y) / (b.x - a.x);
        };
  
        var decreasingCorner = upperRight,
          increasingCorner = lowerRight;
  
        // Our expectations for decreasing or increasing slope values
        // depends on which direction the submenu opens relative to the
        // main menu. By default, if the menu opens on the right, we
        // expect the slope between the cursor and the upper right
        // corner to decrease over time, as explained above. If the
        // submenu opens in a different direction, we change our slope
        // expectations.
        if (options.submenuDirection == "left") {
          decreasingCorner = lowerLeft;
          increasingCorner = upperLeft;
        } else if (options.submenuDirection == "below") {
          decreasingCorner = lowerRight;
          increasingCorner = lowerLeft;
        } else if (options.submenuDirection == "above") {
          decreasingCorner = upperLeft;
          increasingCorner = upperRight;
        }
  
        var decreasingSlope = slope(loc, decreasingCorner),
          increasingSlope = slope(loc, increasingCorner),
          prevDecreasingSlope = slope(prevLoc, decreasingCorner),
          prevIncreasingSlope = slope(prevLoc, increasingCorner);
  
        if (decreasingSlope < prevDecreasingSlope && increasingSlope > prevIncreasingSlope) {
          // Mouse is moving from previous location towards the
          // currently activated submenu. Delay before activating a
          // new menu row, because user may be moving into submenu.
          lastDelayLoc = loc;
          return DELAY;
        }
  
        lastDelayLoc = null;
        return 0;
      };
  
      var reset = function(triggerDeactivate) {
        if (timeoutId) {
          clearTimeout(timeoutId);
        }
  
        if (activeRow && triggerDeactivate) {
          options.deactivate(activeRow);
        }
  
        activeRow = null;
      };
  
      var destroyInstance = function() {
        menu.removeEventListener('mouseleave', mouseleaveMenu);  
        document.removeEventListener('mousemove', mouseMoveFallback);
        if(rows.length > 0) {
          for(var i = 0; i < rows.length; i++) {
            rows[i].removeEventListener('mouseenter', mouseenterRow);  
            rows[i].removeEventListener('mouseleave', mouseleaveRow);
            rows[i].removeEventListener('click', clickRow);  
          }
        }
        
      };
  
      /**
       * Hook up initial menu events
       */
      menu.addEventListener('mouseleave', mouseleaveMenu);  
      var rows = (options.rows) ? options.rows : menu.children;
      if(rows.length > 0) {
        for(var i = 0; i < rows.length; i++) {(function(i){
          rows[i].addEventListener('mouseenter', mouseenterRow);  
          rows[i].addEventListener('mouseleave', mouseleaveRow);
          rows[i].addEventListener('click', clickRow);  
        })(i);}
      }
  
      document.addEventListener('mousemove', mouseMoveFallback);
  
      /* Reset/destroy menu */
      menu.addEventListener('reset', function(event){
        reset(event.detail);
      });
      menu.addEventListener('destroy', destroyInstance);
    };
  }());
  
  
// File#: _1_dialog
// Usage: codyhouse.co/license
(function() {
    var Dialog = function(element) {
      this.element = element;
      this.triggers = document.querySelectorAll('[aria-controls="'+this.element.getAttribute('id')+'"]');
      this.firstFocusable = null;
      this.lastFocusable = null;
      this.selectedTrigger = null;
      this.showClass = "dialog--is-visible";
      initDialog(this);
    };
  
    function initDialog(dialog) {
      if ( dialog.triggers ) {
        for(var i = 0; i < dialog.triggers.length; i++) {
          dialog.triggers[i].addEventListener('click', function(event) {
            event.preventDefault();
            dialog.selectedTrigger = event.target;
            showDialog(dialog);
            initDialogEvents(dialog);
          });
        }
      }
      
      // listen to the openDialog event -> open dialog without a trigger button
      dialog.element.addEventListener('openDialog', function(event){
        if(event.detail) self.selectedTrigger = event.detail;
        showDialog(dialog);
        initDialogEvents(dialog);
      });
    };
  
    function showDialog(dialog) {
      Util.addClass(dialog.element, dialog.showClass);
      getFocusableElements(dialog);
      dialog.firstFocusable.focus();
      // wait for the end of transitions before moving focus
      dialog.element.addEventListener("transitionend", function cb(event) {
        dialog.firstFocusable.focus();
        dialog.element.removeEventListener("transitionend", cb);
      });
      emitDialogEvents(dialog, 'dialogIsOpen');
    };
  
    function closeDialog(dialog) {
      Util.removeClass(dialog.element, dialog.showClass);
      dialog.firstFocusable = null;
      dialog.lastFocusable = null;
      if(dialog.selectedTrigger) dialog.selectedTrigger.focus();
      //remove listeners
      cancelDialogEvents(dialog);
      emitDialogEvents(dialog, 'dialogIsClose');
    };
    
    function initDialogEvents(dialog) {
      //add event listeners
      dialog.element.addEventListener('keydown', handleEvent.bind(dialog));
      dialog.element.addEventListener('click', handleEvent.bind(dialog));
    };
  
    function cancelDialogEvents(dialog) {
      //remove event listeners
      dialog.element.removeEventListener('keydown', handleEvent.bind(dialog));
      dialog.element.removeEventListener('click', handleEvent.bind(dialog));
    };
    
    function handleEvent(event) {
      // handle events
      switch(event.type) {
        case 'click': {
          initClick(this, event);
        }
        case 'keydown': {
          initKeyDown(this, event);
        }
      }
    };
    
    function initKeyDown(dialog, event) {
      if( event.keyCode && event.keyCode == 27 || event.key && event.key == 'Escape' ) {
        //close dialog on esc
        closeDialog(dialog);
      } else if( event.keyCode && event.keyCode == 9 || event.key && event.key == 'Tab' ) {
        //trap focus inside dialog
        trapFocus(dialog, event);
      }
    };
  
    function initClick(dialog, event) {
      //close dialog when clicking on close button
      if( !event.target.closest('.js-dialog__close') ) return;
      event.preventDefault();
      closeDialog(dialog);
    };
  
    function trapFocus(dialog, event) {
      if( dialog.firstFocusable == document.activeElement && event.shiftKey) {
        //on Shift+Tab -> focus last focusable element when focus moves out of dialog
        event.preventDefault();
        dialog.lastFocusable.focus();
      }
      if( dialog.lastFocusable == document.activeElement && !event.shiftKey) {
        //on Tab -> focus first focusable element when focus moves out of dialog
        event.preventDefault();
        dialog.firstFocusable.focus();
      }
    };
  
    function getFocusableElements(dialog) {
      //get all focusable elements inside the dialog
      var allFocusable = dialog.element.querySelectorAll('[href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), button:not([disabled]), iframe, object, embed, [tabindex]:not([tabindex="-1"]), [contenteditable], audio[controls], video[controls], summary');
      getFirstVisible(dialog, allFocusable);
      getLastVisible(dialog, allFocusable);
    };
  
    function getFirstVisible(dialog, elements) {
      //get first visible focusable element inside the dialog
      for(var i = 0; i < elements.length; i++) {
        if( elements[i].offsetWidth || elements[i].offsetHeight || elements[i].getClientRects().length ) {
          dialog.firstFocusable = elements[i];
          return true;
        }
      }
    };
  
    function getLastVisible(dialog, elements) {
      //get last visible focusable element inside the dialog
      for(var i = elements.length - 1; i >= 0; i--) {
        if( elements[i].offsetWidth || elements[i].offsetHeight || elements[i].getClientRects().length ) {
          dialog.lastFocusable = elements[i];
          return true;
        }
      }
    };
  
    function emitDialogEvents(dialog, eventName) {
      var event = new CustomEvent(eventName, {detail: dialog.selectedTrigger});
      dialog.element.dispatchEvent(event);
    };
  
    //initialize the Dialog objects
    var dialogs = document.getElementsByClassName('js-dialog');
    if( dialogs.length > 0 ) {
      for( var i = 0; i < dialogs.length; i++) {
        (function(i){new Dialog(dialogs[i]);})(i);
      }
    }
  }());
// File#: _1_file-upload
// Usage: codyhouse.co/license
(function() {
    var InputFile = function(element) {
      this.element = element;
      this.input = this.element.getElementsByClassName('file-upload__input')[0];
      this.label = this.element.getElementsByClassName('file-upload__label')[0];
      this.multipleUpload = this.input.hasAttribute('multiple'); // allow for multiple files selection
      
      // this is the label text element -> when user selects a file, it will be changed from the default value to the name of the file 
      this.labelText = this.element.getElementsByClassName('file-upload__text')[0];
      this.initialLabel = this.labelText.textContent;
  
      initInputFileEvents(this);
    }; 
  
    function initInputFileEvents(inputFile) {
      // make label focusable
      inputFile.label.setAttribute('tabindex', '0');
      inputFile.input.setAttribute('tabindex', '-1');
  
      // move focus from input to label -> this is triggered when a file is selected or the file picker modal is closed
      inputFile.input.addEventListener('focusin', function(event){ 
        inputFile.label.focus();
      });
  
      // press 'Enter' key on label element -> trigger file selection
      inputFile.label.addEventListener('keydown', function(event) {
        if( event.keyCode && event.keyCode == 13 || event.key && event.key.toLowerCase() == 'enter') {inputFile.input.click();}
      });
  
      // file has been selected -> update label text
      inputFile.input.addEventListener('change', function(event){ 
        updateInputLabelText(inputFile);
      });
    };
  
    function updateInputLabelText(inputFile) {
      var label = '';
      if(inputFile.input.files && inputFile.input.files.length < 1) { 
        label = inputFile.initialLabel; // no selection -> revert to initial label
      } else if(inputFile.multipleUpload && inputFile.input.files && inputFile.input.files.length > 1) {
        label = inputFile.input.files.length+ ' files'; // multiple selection -> show number of files
      } else {
        label = inputFile.input.value.split('\\').pop(); // single file selection -> show name of the file
      }
      inputFile.labelText.textContent = label;
    };
  
    //initialize the InputFile objects
    var inputFiles = document.getElementsByClassName('file-upload');
    if( inputFiles.length > 0 ) {
      for( var i = 0; i < inputFiles.length; i++) {
        (function(i){new InputFile(inputFiles[i]);})(i);
      }
    }
  }());
// File#: _1_form-validator
// Usage: codyhouse.co/license
(function() {
    var FormValidator = function(opts) {
      this.options = Util.extend(FormValidator.defaults , opts);
      this.element = this.options.element;
      this.input = [];
      this.textarea = [];
      this.select = [];
      this.errorFields = [];
      this.errorFieldListeners = [];
      initFormValidator(this);
    };
  
    //public functions
    FormValidator.prototype.validate = function(cb) {
      validateForm(this);
      if(cb) cb(this.errorFields);
    };
  
    // private methods
    function initFormValidator(formValidator) {
      formValidator.input = formValidator.element.querySelectorAll('input');
      formValidator.textarea = formValidator.element.querySelectorAll('textarea');
      formValidator.select = formValidator.element.querySelectorAll('select');
    };
  
    function validateForm(formValidator) {
      // reset input with errors
      formValidator.errorFields = []; 
      // remove change/input events from fields with error
      resetEventListeners(formValidator);
      
      // loop through fields and push to errorFields if there are errors
      for(var i = 0; i < formValidator.input.length; i++) {
        validateField(formValidator, formValidator.input[i]);
      }
  
      for(var i = 0; i < formValidator.textarea.length; i++) {
        validateField(formValidator, formValidator.textarea[i]);
      }
  
      for(var i = 0; i < formValidator.select.length; i++) {
        validateField(formValidator, formValidator.select[i]);
      }
  
      // show errors if any was found
      for(var i = 0; i < formValidator.errorFields.length; i++) {
        showError(formValidator, formValidator.errorFields[i]);
      }
  
      // move focus to first field with error
      if(formValidator.errorFields.length > 0) formValidator.errorFields[0].focus();
    };
  
    function validateField(formValidator, field) {
      if(!field.checkValidity()) {
        formValidator.errorFields.push(field);
        return;
      }
      // check for custom functions
      var customValidate = field.getAttribute('data-validate');
      if(customValidate && formValidator.options.customValidate[customValidate]) {
        formValidator.options.customValidate[customValidate](field, function(result) {
          if(!result) formValidator.errorFields.push(field);
        });
      }
    };
  
    function showError(formValidator, field) {
      // add error classes
      toggleErrorClasses(formValidator, field, true);
  
      // add event listener
      var index = formValidator.errorFieldListeners.length;
      formValidator.errorFieldListeners[index] = function() {
        toggleErrorClasses(formValidator, field, false);
        field.removeEventListener('change', formValidator.errorFieldListeners[index]);
        field.removeEventListener('input', formValidator.errorFieldListeners[index]);
      };
      field.addEventListener('change', formValidator.errorFieldListeners[index]);
      field.addEventListener('input', formValidator.errorFieldListeners[index]);
    };
  
    function toggleErrorClasses(formValidator, field, bool) {
      bool ? Util.addClass(field, formValidator.options.inputErrorClass) : Util.removeClass(field, formValidator.options.inputErrorClass);
      if(formValidator.options.inputWrapperErrorClass) {
        var wrapper = field.closest('.js-form-validate__input-wrapper');
        if(wrapper) {
          bool ? Util.addClass(wrapper, formValidator.options.inputWrapperErrorClass) : Util.removeClass(wrapper, formValidator.options.inputWrapperErrorClass);
        }
      }
    };
  
    function resetEventListeners(formValidator) {
      for(var i = 0; i < formValidator.errorFields.length; i++) {
        toggleErrorClasses(formValidator, formValidator.errorFields[i], false);
        formValidator.errorFields[i].removeEventListener('change', formValidator.errorFieldListeners[i]);
        formValidator.errorFields[i].removeEventListener('input', formValidator.errorFieldListeners[i]);
      }
  
      formValidator.errorFields = [];
      formValidator.errorFieldListeners = [];
    };
    
    FormValidator.defaults = {
      element : '',
      inputErrorClass : 'form-control--error',
      inputWrapperErrorClass: 'form-validate__input-wrapper--error',
      customValidate: {}
    };
    window.FormValidator = FormValidator;
  }());
// File#: _1_hiding-nav
// Usage: codyhouse.co/license
(function() {
    var hidingNav = document.getElementsByClassName('js-hide-nav');
    if(hidingNav.length > 0 && window.requestAnimationFrame) {
      var mainNav = Array.prototype.filter.call(hidingNav, function(element) {
        return Util.hasClass(element, 'js-hide-nav--main');
      }),
      subNav = Array.prototype.filter.call(hidingNav, function(element) {
        return Util.hasClass(element, 'js-hide-nav--sub');
      });
      
      var scrolling = false,
        previousTop = window.scrollY,
        currentTop = window.scrollY,
        scrollDelta = 10,
        scrollOffset = 150, // scrollY needs to be bigger than scrollOffset to hide navigation
        headerHeight = 0; 
  
      var navIsFixed = false; // check if main navigation is fixed
      if(mainNav.length > 0 && Util.hasClass(mainNav[0], 'hide-nav--fixed')) navIsFixed = true;
  
      // store button that triggers navigation on mobile
      var triggerMobile = getTriggerMobileMenu();
      var prevElement = createPrevElement();
      var mainNavTop = 0;
      // list of classes the hide-nav has when it is expanded -> do not hide if it has those classes
      var navOpenClasses = hidingNav[0].getAttribute('data-nav-target-class'),
        navOpenArrayClasses = [];
      if(navOpenClasses) navOpenArrayClasses = navOpenClasses.split(' ');
      getMainNavTop();
      if(mainNavTop > 0) {
        scrollOffset = scrollOffset + mainNavTop;
      }
      
      // init navigation and listen to window scroll event
      getHeaderHeight();
      initSecondaryNav();
      initFixedNav();
      resetHideNav();
      window.addEventListener('scroll', function(event){
        if(scrolling) return;
        scrolling = true;
        window.requestAnimationFrame(resetHideNav);
      });
  
      window.addEventListener('resize', function(event){
        if(scrolling) return;
        scrolling = true;
        window.requestAnimationFrame(function(){
          if(headerHeight > 0) {
            getMainNavTop();
            getHeaderHeight();
            initSecondaryNav();
            initFixedNav();
          }
          // reset both navigation
          hideNavScrollUp();
  
          scrolling = false;
        });
      });
  
      function getHeaderHeight() {
        headerHeight = mainNav[0].offsetHeight;
      };
  
      function initSecondaryNav() { // if there's a secondary nav, set its top equal to the header height
        if(subNav.length < 1 || mainNav.length < 1) return;
        subNav[0].style.top = (headerHeight - 1)+'px';
      };
  
      function initFixedNav() {
        if(!navIsFixed || mainNav.length < 1) return;
        mainNav[0].style.marginBottom = '-'+headerHeight+'px';
      };
  
      function resetHideNav() { // check if navs need to be hidden/revealed
        currentTop = window.scrollY;
        if(currentTop - previousTop > scrollDelta && currentTop > scrollOffset) {
          hideNavScrollDown();
        } else if( previousTop - currentTop > scrollDelta || (previousTop - currentTop > 0 && currentTop < scrollOffset) ) {
          hideNavScrollUp();
        } else if( previousTop - currentTop > 0 && subNav.length > 0 && subNav[0].getBoundingClientRect().top > 0) {
          setTranslate(subNav[0], '0%');
        }
        // if primary nav is fixed -> toggle bg class
        if(navIsFixed) {
          var scrollTop = window.scrollY || window.pageYOffset;
          Util.toggleClass(mainNav[0], 'hide-nav--has-bg', (scrollTop > headerHeight + mainNavTop));
        }
        previousTop = currentTop;
        scrolling = false;
      };
  
      function hideNavScrollDown() {
        // if there's a secondary nav -> it has to reach the top before hiding nav
        if( subNav.length  > 0 && subNav[0].getBoundingClientRect().top > headerHeight) return;
        // on mobile -> hide navigation only if dropdown is not open
        if(triggerMobile && triggerMobile.getAttribute('aria-expanded') == "true") return;
        // check if main nav has one of the following classes
        if( mainNav.length > 0 && (!navOpenClasses || !checkNavExpanded())) {
          setTranslate(mainNav[0], '-100%'); 
          mainNav[0].addEventListener('transitionend', addOffCanvasClass);
        }
        if( subNav.length  > 0 ) setTranslate(subNav[0], '-'+headerHeight+'px');
      };
  
      function hideNavScrollUp() {
        if( mainNav.length > 0 ) {setTranslate(mainNav[0], '0%'); Util.removeClass(mainNav[0], 'hide-nav--off-canvas');mainNav[0].removeEventListener('transitionend', addOffCanvasClass);}
        if( subNav.length  > 0 ) setTranslate(subNav[0], '0%');
      };
  
      function addOffCanvasClass() {
        mainNav[0].removeEventListener('transitionend', addOffCanvasClass);
        Util.addClass(mainNav[0], 'hide-nav--off-canvas');
      };
  
      function setTranslate(element, val) {
        element.style.transform = 'translateY('+val+')';
      };
  
      function getTriggerMobileMenu() {
        // store trigger that toggle mobile navigation dropdown
        var triggerMobileClass = hidingNav[0].getAttribute('data-mobile-trigger');
        if(!triggerMobileClass) return false;
        if(triggerMobileClass.indexOf('#') == 0) { // get trigger by ID
          var trigger = document.getElementById(triggerMobileClass.replace('#', ''));
          if(trigger) return trigger;
        } else { // get trigger by class name
          var trigger = hidingNav[0].getElementsByClassName(triggerMobileClass);
          if(trigger.length > 0) return trigger[0];
        }
        
        return false;
      };
  
      function createPrevElement() {
        // create element to be inserted right before the mainNav to get its top value
        if( mainNav.length < 1) return false;
        var newElement = document.createElement("div"); 
        newElement.setAttribute('aria-hidden', 'true');
        mainNav[0].parentElement.insertBefore(newElement, mainNav[0]);
        var prevElement =  mainNav[0].previousElementSibling;
        prevElement.style.opacity = '0';
        return prevElement;
      };
  
      function getMainNavTop() {
        if(!prevElement) return;
        mainNavTop = prevElement.getBoundingClientRect().top + window.scrollY;
      };
  
      function checkNavExpanded() {
        var navIsOpen = false;
        for(var i = 0; i < navOpenArrayClasses.length; i++){
          if(Util.hasClass(mainNav[0], navOpenArrayClasses[i].trim())) {
            navIsOpen = true;
            break;
          }
        }
        return navIsOpen;
      };
      
    } else {
      // if window requestAnimationFrame is not supported -> add bg class to fixed header
      var mainNav = document.getElementsByClassName('js-hide-nav--main');
      if(mainNav.length < 1) return;
      if(Util.hasClass(mainNav[0], 'hide-nav--fixed')) Util.addClass(mainNav[0], 'hide-nav--has-bg');
    }
  }());
// File#: _1_menu
// Usage: codyhouse.co/license
(function() {
    var Menu = function(element) {
      this.element = element;
      this.elementId = this.element.getAttribute('id');
      this.menuItems = this.element.getElementsByClassName('js-menu__content');
      this.trigger = document.querySelectorAll('[aria-controls="'+this.elementId+'"]');
      this.selectedTrigger = false;
      this.menuIsOpen = false;
      this.initMenu();
      this.initMenuEvents();
    };	
  
    Menu.prototype.initMenu = function() {
      // init aria-labels
      for(var i = 0; i < this.trigger.length; i++) {
        Util.setAttributes(this.trigger[i], {'aria-expanded': 'false', 'aria-haspopup': 'true'});
      }
      // init tabindex
      for(var i = 0; i < this.menuItems.length; i++) {
        this.menuItems[i].setAttribute('tabindex', '0');
      }
    };
  
    Menu.prototype.initMenuEvents = function() {
      var self = this;
      for(var i = 0; i < this.trigger.length; i++) {(function(i){
        self.trigger[i].addEventListener('click', function(event){
          event.preventDefault();
          // if the menu had been previously opened by another trigger element -> close it first and reopen in the right position
          if(Util.hasClass(self.element, 'menu--is-visible') && self.selectedTrigger !=  self.trigger[i]) {
            self.toggleMenu(false, false); // close menu
          }
          // toggle menu
          self.selectedTrigger = self.trigger[i];
          self.toggleMenu(!Util.hasClass(self.element, 'menu--is-visible'), true);
        });
      })(i);}
      
      // keyboard events
      this.element.addEventListener('keydown', function(event) {
        // use up/down arrow to navigate list of menu items
        if( !Util.hasClass(event.target, 'js-menu__content') ) return;
        if( (event.keyCode && event.keyCode == 40) || (event.key && event.key.toLowerCase() == 'arrowdown') ) {
          self.navigateItems(event, 'next');
        } else if( (event.keyCode && event.keyCode == 38) || (event.key && event.key.toLowerCase() == 'arrowup') ) {
          self.navigateItems(event, 'prev');
        }
      });
    };
  
    Menu.prototype.toggleMenu = function(bool, moveFocus) {
      var self = this;
      // toggle menu visibility
      Util.toggleClass(this.element, 'menu--is-visible', bool);
      this.menuIsOpen = bool;
      if(bool) {
        this.selectedTrigger.setAttribute('aria-expanded', 'true');
        Util.moveFocus(this.menuItems[0]);
        this.element.addEventListener("transitionend", function(event) {Util.moveFocus(self.menuItems[0]);}, {once: true});
        // position the menu element
        this.positionMenu();
        // add class to menu trigger
        Util.addClass(this.selectedTrigger, 'menu-control--active');
      } else if(this.selectedTrigger) {
        this.selectedTrigger.setAttribute('aria-expanded', 'false');
        if(moveFocus) Util.moveFocus(this.selectedTrigger);
        // remove class from menu trigger
        Util.removeClass(this.selectedTrigger, 'menu-control--active');
        this.selectedTrigger = false;
      }
    };
  
    Menu.prototype.positionMenu = function(event, direction) {
      var selectedTriggerPosition = this.selectedTrigger.getBoundingClientRect(),
        menuOnTop = (window.innerHeight - selectedTriggerPosition.bottom) < selectedTriggerPosition.top;
        // menuOnTop = window.innerHeight < selectedTriggerPosition.bottom + this.element.offsetHeight;
        
      var left = selectedTriggerPosition.left,
        right = (window.innerWidth - selectedTriggerPosition.right),
        isRight = (window.innerWidth < selectedTriggerPosition.left + this.element.offsetWidth);
  
      var horizontal = isRight ? 'right: '+right+'px;' : 'left: '+left+'px;',
        vertical = menuOnTop
          ? 'bottom: '+(window.innerHeight - selectedTriggerPosition.top)+'px;'
          : 'top: '+selectedTriggerPosition.bottom+'px;';
      // check right position is correct -> otherwise set left to 0
      if( isRight && (right + this.element.offsetWidth) > window.innerWidth) horizontal = 'left: '+ parseInt((window.innerWidth - this.element.offsetWidth)/2)+'px;';
      var maxHeight = menuOnTop ? selectedTriggerPosition.top - 20 : window.innerHeight - selectedTriggerPosition.bottom - 20;
      this.element.setAttribute('style', horizontal + vertical +'max-height:'+Math.floor(maxHeight)+'px;');
    };
  
    Menu.prototype.navigateItems = function(event, direction) {
      event.preventDefault();
      var index = Util.getIndexInArray(this.menuItems, event.target),
        nextIndex = direction == 'next' ? index + 1 : index - 1;
      if(nextIndex < 0) nextIndex = this.menuItems.length - 1;
      if(nextIndex > this.menuItems.length - 1) nextIndex = 0;
      Util.moveFocus(this.menuItems[nextIndex]);
    };
  
    Menu.prototype.checkMenuFocus = function() {
      var menuParent = document.activeElement.closest('.js-menu');
      if (!menuParent || !this.element.contains(menuParent)) this.toggleMenu(false, false);
    };
  
    Menu.prototype.checkMenuClick = function(target) {
      if( !this.element.contains(target) && !target.closest('[aria-controls="'+this.elementId+'"]')) this.toggleMenu(false);
    };
  
    window.Menu = Menu;
  
    //initialize the Menu objects
    var menus = document.getElementsByClassName('js-menu');
    if( menus.length > 0 ) {
      var menusArray = [];
      var scrollingContainers = [];
      for( var i = 0; i < menus.length; i++) {
        (function(i){
          menusArray.push(new Menu(menus[i]));
          var scrollableElement = menus[i].getAttribute('data-scrollable-element');
          if(scrollableElement && !scrollingContainers.includes(scrollableElement)) scrollingContainers.push(scrollableElement);
        })(i);
      }
  
      // listen for key events
      window.addEventListener('keyup', function(event){
        if( event.keyCode && event.keyCode == 9 || event.key && event.key.toLowerCase() == 'tab' ) {
          //close menu if focus is outside menu element
          menusArray.forEach(function(element){
            element.checkMenuFocus();
          });
        } else if( event.keyCode && event.keyCode == 27 || event.key && event.key.toLowerCase() == 'escape' ) {
          // close menu on 'Esc'
          menusArray.forEach(function(element){
            element.toggleMenu(false, false);
          });
        } 
      });
      // close menu when clicking outside it
      window.addEventListener('click', function(event){
        menusArray.forEach(function(element){
          element.checkMenuClick(event.target);
        });
      });
      // on resize -> close all menu elements
      window.addEventListener('resize', function(event){
        menusArray.forEach(function(element){
          element.toggleMenu(false, false);
        });
      });
      // on scroll -> close all menu elements
      window.addEventListener('scroll', function(event){
        menusArray.forEach(function(element){
          if(element.menuIsOpen) element.toggleMenu(false, false);
        });
      });
      // take into account additinal scrollable containers
      for(var j = 0; j < scrollingContainers.length; j++) {
        var scrollingContainer = document.querySelector(scrollingContainers[j]);
        if(scrollingContainer) {
          scrollingContainer.addEventListener('scroll', function(event){
            menusArray.forEach(function(element){
              if(element.menuIsOpen) element.toggleMenu(false, false);
            });
          });
        }
      }
    }
  }());
// File#: _1_popover
// Usage: codyhouse.co/license
(function() {
    var Popover = function(element) {
      this.element = element;
      this.elementId = this.element.getAttribute('id');
      this.trigger = document.querySelectorAll('[aria-controls="'+this.elementId+'"]');
      this.selectedTrigger = false;
      this.popoverVisibleClass = 'popover--is-visible';
      this.selectedTriggerClass = 'popover-control--active';
      this.popoverIsOpen = false;
      // focusable elements
      this.firstFocusable = false;
      this.lastFocusable = false;
      // position target - position tooltip relative to a specified element
      this.positionTarget = getPositionTarget(this);
      // gap between element and viewport - if there's max-height 
      this.viewportGap = parseInt(getComputedStyle(this.element).getPropertyValue('--popover-viewport-gap')) || 20;
      initPopover(this);
      initPopoverEvents(this);
    };
  
    // public methods
    Popover.prototype.togglePopover = function(bool, moveFocus) {
      togglePopover(this, bool, moveFocus);
    };
  
    Popover.prototype.checkPopoverClick = function(target) {
      checkPopoverClick(this, target);
    };
  
    Popover.prototype.checkPopoverFocus = function() {
      checkPopoverFocus(this);
    };
  
    // private methods
    function getPositionTarget(popover) {
      // position tooltip relative to a specified element - if provided
      var positionTargetSelector = popover.element.getAttribute('data-position-target');
      if(!positionTargetSelector) return false;
      var positionTarget = document.querySelector(positionTargetSelector);
      return positionTarget;
    };
  
    function initPopover(popover) {
      // init aria-labels
      for(var i = 0; i < popover.trigger.length; i++) {
        Util.setAttributes(popover.trigger[i], {'aria-expanded': 'false', 'aria-haspopup': 'true'});
      }
    };
    
    function initPopoverEvents(popover) {
      for(var i = 0; i < popover.trigger.length; i++) {(function(i){
        popover.trigger[i].addEventListener('click', function(event){
          event.preventDefault();
          // if the popover had been previously opened by another trigger element -> close it first and reopen in the right position
          if(Util.hasClass(popover.element, popover.popoverVisibleClass) && popover.selectedTrigger !=  popover.trigger[i]) {
            togglePopover(popover, false, false); // close menu
          }
          // toggle popover
          popover.selectedTrigger = popover.trigger[i];
          togglePopover(popover, !Util.hasClass(popover.element, popover.popoverVisibleClass), true);
        });
      })(i);}
      
      // trap focus
      popover.element.addEventListener('keydown', function(event){
        if( event.keyCode && event.keyCode == 9 || event.key && event.key == 'Tab' ) {
          //trap focus inside popover
          trapFocus(popover, event);
        }
      });
  
      // custom events -> open/close popover
      popover.element.addEventListener('openPopover', function(event){
        togglePopover(popover, true);
      });
  
      popover.element.addEventListener('closePopover', function(event){
        togglePopover(popover, false, event.detail);
      });
    };
    
    function togglePopover(popover, bool, moveFocus) {
      // toggle popover visibility
      Util.toggleClass(popover.element, popover.popoverVisibleClass, bool);
      popover.popoverIsOpen = bool;
      if(bool) {
        popover.selectedTrigger.setAttribute('aria-expanded', 'true');
        getFocusableElements(popover);
        // move focus
        focusPopover(popover);
        popover.element.addEventListener("transitionend", function(event) {focusPopover(popover);}, {once: true});
        // position the popover element
        positionPopover(popover);
        // add class to popover trigger
        Util.addClass(popover.selectedTrigger, popover.selectedTriggerClass);
      } else if(popover.selectedTrigger) {
        popover.selectedTrigger.setAttribute('aria-expanded', 'false');
        if(moveFocus) Util.moveFocus(popover.selectedTrigger);
        // remove class from menu trigger
        Util.removeClass(popover.selectedTrigger, popover.selectedTriggerClass);
        popover.selectedTrigger = false;
      }
    };
    
    function focusPopover(popover) {
      if(popover.firstFocusable) {
        popover.firstFocusable.focus();
      } else {
        Util.moveFocus(popover.element);
      }
    };
  
    function positionPopover(popover) {
      // reset popover position
      resetPopoverStyle(popover);
      var selectedTriggerPosition = (popover.positionTarget) ? popover.positionTarget.getBoundingClientRect() : popover.selectedTrigger.getBoundingClientRect();
      
      var menuOnTop = (window.innerHeight - selectedTriggerPosition.bottom) < selectedTriggerPosition.top;
        
      var left = selectedTriggerPosition.left,
        right = (window.innerWidth - selectedTriggerPosition.right),
        isRight = (window.innerWidth < selectedTriggerPosition.left + popover.element.offsetWidth);
  
      var horizontal = isRight ? 'right: '+right+'px;' : 'left: '+left+'px;',
        vertical = menuOnTop
          ? 'bottom: '+(window.innerHeight - selectedTriggerPosition.top)+'px;'
          : 'top: '+selectedTriggerPosition.bottom+'px;';
      // check right position is correct -> otherwise set left to 0
      if( isRight && (right + popover.element.offsetWidth) > window.innerWidth) horizontal = 'left: '+ parseInt((window.innerWidth - popover.element.offsetWidth)/2)+'px;';
      // check if popover needs a max-height (user will scroll inside the popover)
      var maxHeight = menuOnTop ? selectedTriggerPosition.top - popover.viewportGap : window.innerHeight - selectedTriggerPosition.bottom - popover.viewportGap;
  
      var initialStyle = popover.element.getAttribute('style');
      if(!initialStyle) initialStyle = '';
      popover.element.setAttribute('style', initialStyle + horizontal + vertical +'max-height:'+Math.floor(maxHeight)+'px;');
    };
    
    function resetPopoverStyle(popover) {
      // remove popover inline style before appling new style
      popover.element.style.maxHeight = '';
      popover.element.style.top = '';
      popover.element.style.bottom = '';
      popover.element.style.left = '';
      popover.element.style.right = '';
    };
  
    function checkPopoverClick(popover, target) {
      // close popover when clicking outside it
      if(!popover.popoverIsOpen) return;
      if(!popover.element.contains(target) && !target.closest('[aria-controls="'+popover.elementId+'"]')) togglePopover(popover, false);
    };
  
    function checkPopoverFocus(popover) {
      // on Esc key -> close popover if open and move focus (if focus was inside popover)
      if(!popover.popoverIsOpen) return;
      var popoverParent = document.activeElement.closest('.js-popover');
      togglePopover(popover, false, popoverParent);
    };
    
    function getFocusableElements(popover) {
      //get all focusable elements inside the popover
      var allFocusable = popover.element.querySelectorAll(focusableElString);
      getFirstVisible(popover, allFocusable);
      getLastVisible(popover, allFocusable);
    };
  
    function getFirstVisible(popover, elements) {
      //get first visible focusable element inside the popover
      for(var i = 0; i < elements.length; i++) {
        if( isVisible(elements[i]) ) {
          popover.firstFocusable = elements[i];
          break;
        }
      }
    };
  
    function getLastVisible(popover, elements) {
      //get last visible focusable element inside the popover
      for(var i = elements.length - 1; i >= 0; i--) {
        if( isVisible(elements[i]) ) {
          popover.lastFocusable = elements[i];
          break;
        }
      }
    };
  
    function trapFocus(popover, event) {
      if( popover.firstFocusable == document.activeElement && event.shiftKey) {
        //on Shift+Tab -> focus last focusable element when focus moves out of popover
        event.preventDefault();
        popover.lastFocusable.focus();
      }
      if( popover.lastFocusable == document.activeElement && !event.shiftKey) {
        //on Tab -> focus first focusable element when focus moves out of popover
        event.preventDefault();
        popover.firstFocusable.focus();
      }
    };
    
    function isVisible(element) {
      // check if element is visible
      return element.offsetWidth || element.offsetHeight || element.getClientRects().length;
    };
  
    window.Popover = Popover;
  
    //initialize the Popover objects
    var popovers = document.getElementsByClassName('js-popover');
    // generic focusable elements string selector
    var focusableElString = '[href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), button:not([disabled]), iframe, object, embed, [tabindex]:not([tabindex="-1"]), [contenteditable], audio[controls], video[controls], summary';
    
    if( popovers.length > 0 ) {
      var popoversArray = [];
      var scrollingContainers = [];
      for( var i = 0; i < popovers.length; i++) {
        (function(i){
          popoversArray.push(new Popover(popovers[i]));
          var scrollableElement = popovers[i].getAttribute('data-scrollable-element');
          if(scrollableElement && !scrollingContainers.includes(scrollableElement)) scrollingContainers.push(scrollableElement);
        })(i);
      }
  
      // listen for key events
      window.addEventListener('keyup', function(event){
        if( event.keyCode && event.keyCode == 27 || event.key && event.key.toLowerCase() == 'escape' ) {
          // close popover on 'Esc'
          popoversArray.forEach(function(element){
            element.checkPopoverFocus();
          });
        } 
      });
      // close popover when clicking outside it
      window.addEventListener('click', function(event){
        popoversArray.forEach(function(element){
          element.checkPopoverClick(event.target);
        });
      });
      // on resize -> close all popover elements
      window.addEventListener('resize', function(event){
        popoversArray.forEach(function(element){
          element.togglePopover(false, false);
        });
      });
      // on scroll -> close all popover elements
      window.addEventListener('scroll', function(event){
        popoversArray.forEach(function(element){
          if(element.popoverIsOpen) element.togglePopover(false, false);
        });
      });
      // take into account additinal scrollable containers
      for(var j = 0; j < scrollingContainers.length; j++) {
        var scrollingContainer = document.querySelector(scrollingContainers[j]);
        if(scrollingContainer) {
          scrollingContainer.addEventListener('scroll', function(event){
            popoversArray.forEach(function(element){
              if(element.popoverIsOpen) element.togglePopover(false, false);
            });
          });
        }
      }
    }
  }());
// File#: _1_read-more
// Usage: codyhouse.co/license
(function() {
    var ReadMore = function(element) {
      this.element = element;
      this.moreContent = this.element.getElementsByClassName('js-read-more__content');
      this.count = this.element.getAttribute('data-characters') || 200;
      this.counting = 0;
      this.btnClasses = this.element.getAttribute('data-btn-class');
      this.ellipsis = this.element.getAttribute('data-ellipsis') && this.element.getAttribute('data-ellipsis') == 'off' ? false : true;
      this.btnShowLabel = 'Read more';
      this.btnHideLabel = 'Read less';
      this.toggleOff = this.element.getAttribute('data-toggle') && this.element.getAttribute('data-toggle') == 'off' ? false : true;
      if( this.moreContent.length == 0 ) splitReadMore(this);
      setBtnLabels(this);
      initReadMore(this);
    };
  
    function splitReadMore(readMore) { 
      splitChildren(readMore.element, readMore); // iterate through children and hide content
    };
  
    function splitChildren(parent, readMore) {
      if(readMore.counting >= readMore.count) {
        Util.addClass(parent, 'js-read-more__content');
        return parent.outerHTML;
      }
      var children = parent.childNodes;
      var content = '';
      for(var i = 0; i < children.length; i++) {
        if (children[i].nodeType == Node.TEXT_NODE) {
          content = content + wrapText(children[i], readMore);
        } else {
          content = content + splitChildren(children[i], readMore);
        }
      }
      parent.innerHTML = content;
      return parent.outerHTML;
    };
  
    function wrapText(element, readMore) {
      var content = element.textContent;
      if(content.replace(/\s/g,'').length == 0) return '';// check if content is empty
      if(readMore.counting >= readMore.count) {
        return '<span class="js-read-more__content">' + content + '</span>';
      }
      if(readMore.counting + content.length < readMore.count) {
        readMore.counting = readMore.counting + content.length;
        return content;
      }
      var firstContent = content.substr(0, readMore.count - readMore.counting);
      firstContent = firstContent.substr(0, Math.min(firstContent.length, firstContent.lastIndexOf(" ")));
      var secondContent = content.substr(firstContent.length, content.length);
      readMore.counting = readMore.count;
      return firstContent + '<span class="js-read-more__content">' + secondContent + '</span>';
    };
  
    function setBtnLabels(readMore) { // set custom labels for read More/Less btns
      var btnLabels = readMore.element.getAttribute('data-btn-labels');
      if(btnLabels) {
        var labelsArray = btnLabels.split(',');
        readMore.btnShowLabel = labelsArray[0].trim();
        readMore.btnHideLabel = labelsArray[1].trim();
      }
    };
  
    function initReadMore(readMore) { // add read more/read less buttons to the markup
      readMore.moreContent = readMore.element.getElementsByClassName('js-read-more__content');
      if( readMore.moreContent.length == 0 ) {
        Util.addClass(readMore.element, 'read-more--loaded');
        return;
      }
      var btnShow = ' <button class="js-read-more__btn '+readMore.btnClasses+'">'+readMore.btnShowLabel+'</button>';
      var btnHide = ' <button class="js-read-more__btn is-hidden '+readMore.btnClasses+'">'+readMore.btnHideLabel+'</button>';
      if(readMore.ellipsis) {
        btnShow = '<span class="js-read-more__ellipsis" aria-hidden="true">...</span>'+ btnShow;
      }
  
      readMore.moreContent[readMore.moreContent.length - 1].insertAdjacentHTML('afterend', btnHide);
      readMore.moreContent[0].insertAdjacentHTML('afterend', btnShow);
      resetAppearance(readMore);
      initEvents(readMore);
    };
  
    function resetAppearance(readMore) { // hide part of the content
      for(var i = 0; i < readMore.moreContent.length; i++) Util.addClass(readMore.moreContent[i], 'is-hidden');
      Util.addClass(readMore.element, 'read-more--loaded'); // show entire component
    };
  
    function initEvents(readMore) { // listen to the click on the read more/less btn
      readMore.btnToggle = readMore.element.getElementsByClassName('js-read-more__btn');
      readMore.ellipsis = readMore.element.getElementsByClassName('js-read-more__ellipsis');
  
      readMore.btnToggle[0].addEventListener('click', function(event){
        event.preventDefault();
        updateVisibility(readMore, true);
      });
      readMore.btnToggle[1].addEventListener('click', function(event){
        event.preventDefault();
        updateVisibility(readMore, false);
      });
    };
  
    function updateVisibility(readMore, visibile) {
      for(var i = 0; i < readMore.moreContent.length; i++) Util.toggleClass(readMore.moreContent[i], 'is-hidden', !visibile);
      // reset btns appearance
      Util.toggleClass(readMore.btnToggle[0], 'is-hidden', visibile);
      Util.toggleClass(readMore.btnToggle[1], 'is-hidden', !visibile);
      if(readMore.ellipsis.length > 0 ) Util.toggleClass(readMore.ellipsis[0], 'is-hidden', visibile);
      if(!readMore.toggleOff) Util.addClass(readMore.btn, 'is-hidden');
      // move focus
      if(visibile) {
        var targetTabIndex = readMore.moreContent[0].getAttribute('tabindex');
        Util.moveFocus(readMore.moreContent[0]);
        resetFocusTarget(readMore.moreContent[0], targetTabIndex);
      } else {
        Util.moveFocus(readMore.btnToggle[0]);
      }
    };
  
    function resetFocusTarget(target, tabindex) {
      if( parseInt(target.getAttribute('tabindex')) < 0) {
        target.style.outline = 'none';
        !tabindex && target.removeAttribute('tabindex');
      }
    };
  
    //initialize the ReadMore objects
    var readMore = document.getElementsByClassName('js-read-more');
    if( readMore.length > 0 ) {
      for( var i = 0; i < readMore.length; i++) {
        (function(i){new ReadMore(readMore[i]);})(i);
      }
    };
  }());
// File#: _1_side-navigation
// Usage: codyhouse.co/license
(function() {
    function initSideNav(nav) {
      nav.addEventListener('click', function(event){
        var btn = event.target.closest('.js-sidenav__sublist-control');
        if(!btn) return;
        var listItem = btn.parentElement,
          bool = Util.hasClass(listItem, 'sidenav__item--expanded');
        btn.setAttribute('aria-expanded', !bool);
        Util.toggleClass(listItem, 'sidenav__item--expanded', !bool);
      });
    };
  
    var sideNavs = document.getElementsByClassName('js-sidenav');
    if( sideNavs.length > 0 ) {
      for( var i = 0; i < sideNavs.length; i++) {
        (function(i){initSideNav(sideNavs[i]);})(i);
      }
    }
  }());
// File#: _1_smooth-scrolling
// Usage: codyhouse.co/license
(function() {
    var SmoothScroll = function(element) {
      if(!('CSS' in window) || !CSS.supports('color', 'var(--color-var)')) return;
      this.element = element;
      this.scrollDuration = parseInt(this.element.getAttribute('data-duration')) || 300;
      this.dataElementY = this.element.getAttribute('data-scrollable-element-y') || this.element.getAttribute('data-scrollable-element') || this.element.getAttribute('data-element');
      this.scrollElementY = this.dataElementY ? document.querySelector(this.dataElementY) : window;
      this.dataElementX = this.element.getAttribute('data-scrollable-element-x');
      this.scrollElementX = this.dataElementY ? document.querySelector(this.dataElementX) : window;
      this.initScroll();
    };
  
    SmoothScroll.prototype.initScroll = function() {
      var self = this;
  
      //detect click on link
      this.element.addEventListener('click', function(event){
        event.preventDefault();
        var targetId = event.target.closest('.js-smooth-scroll').getAttribute('href').replace('#', ''),
          target = document.getElementById(targetId),
          targetTabIndex = target.getAttribute('tabindex'),
          windowScrollTop = self.scrollElementY.scrollTop || document.documentElement.scrollTop;
  
        // scroll vertically
        if(!self.dataElementY) windowScrollTop = window.scrollY || document.documentElement.scrollTop;
  
        var scrollElementY = self.dataElementY ? self.scrollElementY : false;
  
        var fixedHeight = self.getFixedElementHeight(); // check if there's a fixed element on the page
        Util.scrollTo(target.getBoundingClientRect().top + windowScrollTop - fixedHeight, self.scrollDuration, function() {
          // scroll horizontally
          self.scrollHorizontally(target, fixedHeight);
          //move the focus to the target element - don't break keyboard navigation
          Util.moveFocus(target);
          history.pushState(false, false, '#'+targetId);
          self.resetTarget(target, targetTabIndex);
        }, scrollElementY);
      });
    };
  
    SmoothScroll.prototype.scrollHorizontally = function(target, delta) {
      var scrollEl = this.dataElementX ? this.scrollElementX : false;
      var windowScrollLeft = this.scrollElementX ? this.scrollElementX.scrollLeft : document.documentElement.scrollLeft;
      var final = target.getBoundingClientRect().left + windowScrollLeft - delta,
        duration = this.scrollDuration;
  
      var element = scrollEl || window;
      var start = element.scrollLeft || document.documentElement.scrollLeft,
        currentTime = null;
  
      if(!scrollEl) start = window.scrollX || document.documentElement.scrollLeft;
      // return if there's no need to scroll
      if(Math.abs(start - final) < 5) return;
          
      var animateScroll = function(timestamp){
        if (!currentTime) currentTime = timestamp;        
        var progress = timestamp - currentTime;
        if(progress > duration) progress = duration;
        var val = Math.easeInOutQuad(progress, start, final-start, duration);
        element.scrollTo({
          left: val,
        });
        if(progress < duration) {
          window.requestAnimationFrame(animateScroll);
        }
      };
  
      window.requestAnimationFrame(animateScroll);
    };
  
    SmoothScroll.prototype.resetTarget = function(target, tabindex) {
      if( parseInt(target.getAttribute('tabindex')) < 0) {
        target.style.outline = 'none';
        !tabindex && target.removeAttribute('tabindex');
      }	
    };
  
    SmoothScroll.prototype.getFixedElementHeight = function() {
      var scrollElementY = this.dataElementY ? this.scrollElementY : document.documentElement;
      var fixedElementDelta = parseInt(getComputedStyle(scrollElementY).getPropertyValue('scroll-padding'));
      if(isNaN(fixedElementDelta) ) { // scroll-padding not supported
        fixedElementDelta = 0;
        var fixedElement = document.querySelector(this.element.getAttribute('data-fixed-element'));
        if(fixedElement) fixedElementDelta = parseInt(fixedElement.getBoundingClientRect().height);
      }
      return fixedElementDelta;
    };
    
    //initialize the Smooth Scroll objects
    var smoothScrollLinks = document.getElementsByClassName('js-smooth-scroll');
    if( smoothScrollLinks.length > 0 && !Util.cssSupports('scroll-behavior', 'smooth') && window.requestAnimationFrame) {
      // you need javascript only if css scroll-behavior is not supported
      for( var i = 0; i < smoothScrollLinks.length; i++) {
        (function(i){new SmoothScroll(smoothScrollLinks[i]);})(i);
      }
    }
  }());
// File#: _1_sub-navigation
// Usage: codyhouse.co/license
(function() {
    var SideNav = function(element) {
      this.element = element;
      this.control = this.element.getElementsByClassName('js-subnav__control');
      this.navList = this.element.getElementsByClassName('js-subnav__wrapper');
      this.closeBtn = this.element.getElementsByClassName('js-subnav__close-btn');
      this.firstFocusable = getFirstFocusable(this);
      this.showClass = 'subnav__wrapper--is-visible';
      this.collapsedLayoutClass = 'subnav--collapsed';
      initSideNav(this);
    };
  
    function getFirstFocusable(sidenav) { // get first focusable element inside the subnav
      if(sidenav.navList.length == 0) return;
      var focusableEle = sidenav.navList[0].querySelectorAll('[href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), button:not([disabled]), iframe, object, embed, [tabindex]:not([tabindex="-1"]), [contenteditable], audio[controls], video[controls], summary'),
          firstFocusable = false;
      for(var i = 0; i < focusableEle.length; i++) {
        if( focusableEle[i].offsetWidth || focusableEle[i].offsetHeight || focusableEle[i].getClientRects().length ) {
          firstFocusable = focusableEle[i];
          break;
        }
      }
  
      return firstFocusable;
    };
  
    function initSideNav(sidenav) {
      checkSideNavLayout(sidenav); // switch from --compressed to --expanded layout
      initSideNavToggle(sidenav); // mobile behavior + layout update on resize
    };
  
    function initSideNavToggle(sidenav) { 
      // custom event emitted when window is resized
      sidenav.element.addEventListener('update-sidenav', function(event){
        checkSideNavLayout(sidenav);
      });
  
      // mobile only
      if(sidenav.control.length == 0 || sidenav.navList.length == 0) return;
      sidenav.control[0].addEventListener('click', function(event){ // open sidenav
        openSideNav(sidenav, event);
      });
      sidenav.element.addEventListener('click', function(event) { // close sidenav when clicking on close button/bg layer
        if(event.target.closest('.js-subnav__close-btn') || Util.hasClass(event.target, 'js-subnav__wrapper')) {
          closeSideNav(sidenav, event);
        }
      });
    };
  
    function openSideNav(sidenav, event) { // open side nav - mobile only
      event.preventDefault();
      sidenav.selectedTrigger = event.target;
      event.target.setAttribute('aria-expanded', 'true');
      Util.addClass(sidenav.navList[0], sidenav.showClass);
      sidenav.navList[0].addEventListener('transitionend', function cb(event){
        sidenav.navList[0].removeEventListener('transitionend', cb);
        sidenav.firstFocusable.focus();
      });
    };
  
    function closeSideNav(sidenav, event, bool) { // close side sidenav - mobile only
      if( !Util.hasClass(sidenav.navList[0], sidenav.showClass) ) return;
      if(event) event.preventDefault();
      Util.removeClass(sidenav.navList[0], sidenav.showClass);
      if(!sidenav.selectedTrigger) return;
      sidenav.selectedTrigger.setAttribute('aria-expanded', 'false');
      if(!bool) sidenav.selectedTrigger.focus();
      sidenav.selectedTrigger = false; 
    };
  
    function checkSideNavLayout(sidenav) { // switch from --compressed to --expanded layout
      var layout = getComputedStyle(sidenav.element, ':before').getPropertyValue('content').replace(/\'|"/g, '');
      if(layout != 'expanded' && layout != 'collapsed') return;
      Util.toggleClass(sidenav.element, sidenav.collapsedLayoutClass, layout != 'expanded');
    };
    
    var sideNav = document.getElementsByClassName('js-subnav'),
      SideNavArray = [],
      j = 0;
    if( sideNav.length > 0) {
      for(var i = 0; i < sideNav.length; i++) {
        var beforeContent = getComputedStyle(sideNav[i], ':before').getPropertyValue('content');
        if(beforeContent && beforeContent !='' && beforeContent !='none') {
          j = j + 1;
        }
        (function(i){SideNavArray.push(new SideNav(sideNav[i]));})(i);
      }
  
      if(j > 0) { // on resize - update sidenav layout
        var resizingId = false,
          customEvent = new CustomEvent('update-sidenav');
        window.addEventListener('resize', function(event){
          clearTimeout(resizingId);
          resizingId = setTimeout(doneResizing, 300);
        });
  
        function doneResizing() {
          for( var i = 0; i < SideNavArray.length; i++) {
            (function(i){SideNavArray[i].element.dispatchEvent(customEvent)})(i);
          };
        };
  
        (window.requestAnimationFrame) // init table layout
          ? window.requestAnimationFrame(doneResizing)
          : doneResizing();
      }
  
      // listen for key events
      window.addEventListener('keyup', function(event){
        if( (event.keyCode && event.keyCode == 27) || (event.key && event.key.toLowerCase() == 'escape' )) {// listen for esc key - close navigation on mobile if open
          for(var i = 0; i < SideNavArray.length; i++) {
            (function(i){closeSideNav(SideNavArray[i], event);})(i);
          };
        }
        if( (event.keyCode && event.keyCode == 9) || (event.key && event.key.toLowerCase() == 'tab' )) { // listen for tab key - close navigation on mobile if open when nav loses focus
          if( document.activeElement.closest('.js-subnav__wrapper')) return;
          for(var i = 0; i < SideNavArray.length; i++) {
            (function(i){closeSideNav(SideNavArray[i], event, true);})(i);
          };
        }
      });
    }
  }());
// File#: _1_switch-icon
// Usage: codyhouse.co/license
(function() {
    var switchIcons = document.getElementsByClassName('js-switch-icon');
    if( switchIcons.length > 0 ) {
      for(var i = 0; i < switchIcons.length; i++) {(function(i){
        if( !Util.hasClass(switchIcons[i], 'switch-icon--hover') ) initswitchIcons(switchIcons[i]);
      })(i);}
  
      function initswitchIcons(btn) {
        btn.addEventListener('click', function(event){	
          event.preventDefault();
          var status = !Util.hasClass(btn, 'switch-icon--state-b');
          Util.toggleClass(btn, 'switch-icon--state-b', status);
          // emit custom event
          var event = new CustomEvent('switch-icon-clicked', {detail: status});
          btn.dispatchEvent(event);
        });
      };
    }
  }());
// File#: _1_tabs
// Usage: codyhouse.co/license
(function() {
    var Tab = function(element) {
      this.element = element;
      this.tabList = this.element.getElementsByClassName('js-tabs__controls')[0];
      this.listItems = this.tabList.getElementsByTagName('li');
      this.triggers = this.tabList.getElementsByTagName('a');
      this.panelsList = this.element.getElementsByClassName('js-tabs__panels')[0];
      this.panels = Util.getChildrenByClassName(this.panelsList, 'js-tabs__panel');
      this.hideClass = 'is-hidden';
      this.customShowClass = this.element.getAttribute('data-show-panel-class') ? this.element.getAttribute('data-show-panel-class') : false;
      this.layout = this.element.getAttribute('data-tabs-layout') ? this.element.getAttribute('data-tabs-layout') : 'horizontal';
      // deep linking options
      this.deepLinkOn = this.element.getAttribute('data-deep-link') == 'on';
      // init tabs
      this.initTab();
    };
  
    Tab.prototype.initTab = function() {
      //set initial aria attributes
      this.tabList.setAttribute('role', 'tablist');
      for( var i = 0; i < this.triggers.length; i++) {
        var bool = (i == 0),
          panelId = this.panels[i].getAttribute('id');
        this.listItems[i].setAttribute('role', 'presentation');
        Util.setAttributes(this.triggers[i], {'role': 'tab', 'aria-selected': bool, 'aria-controls': panelId, 'id': 'tab-'+panelId});
        Util.addClass(this.triggers[i], 'js-tabs__trigger'); 
        Util.setAttributes(this.panels[i], {'role': 'tabpanel', 'aria-labelledby': 'tab-'+panelId});
        Util.toggleClass(this.panels[i], this.hideClass, !bool);
  
        if(!bool) this.triggers[i].setAttribute('tabindex', '-1'); 
      }
  
      //listen for Tab events
      this.initTabEvents();
  
      // check deep linking option
      this.initDeepLink();
    };
  
    Tab.prototype.initTabEvents = function() {
      var self = this;
      //click on a new tab -> select content
      this.tabList.addEventListener('click', function(event) {
        if( event.target.closest('.js-tabs__trigger') ) self.triggerTab(event.target.closest('.js-tabs__trigger'), event);
      });
      //arrow keys to navigate through tabs 
      this.tabList.addEventListener('keydown', function(event) {
        ;
        if( !event.target.closest('.js-tabs__trigger') ) return;
        if( tabNavigateNext(event, self.layout) ) {
          event.preventDefault();
          self.selectNewTab('next');
        } else if( tabNavigatePrev(event, self.layout) ) {
          event.preventDefault();
          self.selectNewTab('prev');
        }
      });
    };
  
    Tab.prototype.selectNewTab = function(direction) {
      var selectedTab = this.tabList.querySelector('[aria-selected="true"]'),
        index = Util.getIndexInArray(this.triggers, selectedTab);
      index = (direction == 'next') ? index + 1 : index - 1;
      //make sure index is in the correct interval 
      //-> from last element go to first using the right arrow, from first element go to last using the left arrow
      if(index < 0) index = this.listItems.length - 1;
      if(index >= this.listItems.length) index = 0;	
      this.triggerTab(this.triggers[index]);
      this.triggers[index].focus();
    };
  
    Tab.prototype.triggerTab = function(tabTrigger, event) {
      var self = this;
      event && event.preventDefault();	
      var index = Util.getIndexInArray(this.triggers, tabTrigger);
      //no need to do anything if tab was already selected
      if(this.triggers[index].getAttribute('aria-selected') == 'true') return;
      
      for( var i = 0; i < this.triggers.length; i++) {
        var bool = (i == index);
        Util.toggleClass(this.panels[i], this.hideClass, !bool);
        if(this.customShowClass) Util.toggleClass(this.panels[i], this.customShowClass, bool);
        this.triggers[i].setAttribute('aria-selected', bool);
        bool ? this.triggers[i].setAttribute('tabindex', '0') : this.triggers[i].setAttribute('tabindex', '-1');
      }
  
      // update url if deepLink is on
      if(this.deepLinkOn) {
        history.replaceState(null, '', '#'+tabTrigger.getAttribute('aria-controls'));
      }
    };
  
    Tab.prototype.initDeepLink = function() {
      if(!this.deepLinkOn) return;
      var hash = window.location.hash.substr(1);
      var self = this;
      if(!hash || hash == '') return;
      for(var i = 0; i < this.panels.length; i++) {
        if(this.panels[i].getAttribute('id') == hash) {
          this.triggerTab(this.triggers[i], false);
          setTimeout(function(){self.panels[i].scrollIntoView(true);});
          break;
        }
      };
    };
  
    function tabNavigateNext(event, layout) {
      if(layout == 'horizontal' && (event.keyCode && event.keyCode == 39 || event.key && event.key == 'ArrowRight')) {return true;}
      else if(layout == 'vertical' && (event.keyCode && event.keyCode == 40 || event.key && event.key == 'ArrowDown')) {return true;}
      else {return false;}
    };
  
    function tabNavigatePrev(event, layout) {
      if(layout == 'horizontal' && (event.keyCode && event.keyCode == 37 || event.key && event.key == 'ArrowLeft')) {return true;}
      else if(layout == 'vertical' && (event.keyCode && event.keyCode == 38 || event.key && event.key == 'ArrowUp')) {return true;}
      else {return false;}
    };
    
    //initialize the Tab objects
    var tabs = document.getElementsByClassName('js-tabs');
    if( tabs.length > 0 ) {
      for( var i = 0; i < tabs.length; i++) {
        (function(i){new Tab(tabs[i]);})(i);
      }
    }
  }());
// File#: _2_adv-custom-select
// Usage: codyhouse.co/license
(function() {
    var AdvSelect = function(element) {
      this.element = element;
      this.select = this.element.getElementsByTagName('select')[0];
      this.optGroups = this.select.getElementsByTagName('optgroup');
      this.options = this.select.getElementsByTagName('option');
      this.optionData = getOptionsData(this);
      this.selectId = this.select.getAttribute('id');
      this.selectLabel = document.querySelector('[for='+this.selectId+']')
      this.trigger = this.element.getElementsByClassName('js-adv-select__control')[0];
      this.triggerLabel = this.trigger.getElementsByClassName('js-adv-select__value')[0];
      this.dropdown = document.getElementById(this.trigger.getAttribute('aria-controls'));
  
      initAdvSelect(this); // init markup
      initAdvSelectEvents(this); // init event listeners
    };
  
    function getOptionsData(select) {
      var obj = [],
        dataset = select.options[0].dataset;
  
      function camelCaseToDash( myStr ) {
        return myStr.replace( /([a-z])([A-Z])/g, '$1-$2' ).toLowerCase();
      }
      for (var prop in dataset) {
        if (Object.prototype.hasOwnProperty.call(dataset, prop)) {
          // obj[prop] = select.dataset[prop];
          obj.push(camelCaseToDash(prop));
        }
      }
      return obj;
    };
  
    function initAdvSelect(select) {
      // create custom structure
      createAdvStructure(select);
      // update trigger label
      updateTriggerLabel(select);
      // hide native select and show custom structure
      Util.addClass(select.select, 'is-hidden');
      Util.removeClass(select.trigger, 'is-hidden');
      Util.removeClass(select.dropdown, 'is-hidden');
    };
  
    function initAdvSelectEvents(select) {
      if(select.selectLabel) {
        // move focus to custom trigger when clicking on <select> label
        select.selectLabel.addEventListener('click', function(){
          select.trigger.focus();
        });
      }
  
      // option is selected in dropdown
      select.dropdown.addEventListener('click', function(event){
        triggerSelection(select, event.target);
      });
  
      // keyboard navigation
      select.dropdown.addEventListener('keydown', function(event){
        if(event.keyCode && event.keyCode == 38 || event.key && event.key.toLowerCase() == 'arrowup') {
          keyboardCustomSelect(select, 'prev', event);
        } else if(event.keyCode && event.keyCode == 40 || event.key && event.key.toLowerCase() == 'arrowdown') {
          keyboardCustomSelect(select, 'next', event);
        } else if(event.keyCode && event.keyCode == 13 || event.key && event.key.toLowerCase() == 'enter') {
          triggerSelection(select, document.activeElement);
        }
      });
    };
  
    function createAdvStructure(select) {
      // store optgroup and option structure
      var optgroup = select.dropdown.querySelector('[role="group"]'),
        option = select.dropdown.querySelector('[role="option"]'),
        optgroupClone = false,
        optgroupLabel = false,
        optionClone = false;
      if(optgroup) {
        optgroupClone = optgroup.cloneNode();
        optgroupLabel = document.getElementById(optgroupClone.getAttribute('describedby'));
      }
      if(option) optionClone = option.cloneNode(true);
  
      var dropdownCode = '';
  
      if(select.optGroups.length > 0) {
        for(var i = 0; i < select.optGroups.length; i++) {
          dropdownCode = dropdownCode + getOptGroupCode(select, select.optGroups[i], optgroupClone, optionClone, optgroupLabel, i);
        }
      } else {
        for(var i = 0; i < select.options.length; i++) {
          dropdownCode = dropdownCode + getOptionCode(select, select.options[i], optionClone);
        }
      }
  
      select.dropdown.innerHTML = dropdownCode;
    };
  
    function getOptGroupCode(select, optGroup, optGroupClone, optionClone, optgroupLabel, index) {
      if(!optGroupClone || !optionClone) return '';
      var code = '';
      var options = optGroup.getElementsByTagName('option');
      for(var i = 0; i < options.length; i++) {
        code = code + getOptionCode(select, options[i], optionClone);
      }
      if(optgroupLabel) {
        var label = optgroupLabel.cloneNode(true);
        var id = label.getAttribute('id') + '-'+index;
        label.setAttribute('id', id);
        optGroupClone.setAttribute('describedby', id);
        code = label.outerHTML.replace('{optgroup-label}', optGroup.getAttribute('label')) + code;
      } 
      optGroupClone.innerHTML = code;
      return optGroupClone.outerHTML;
    };
  
    function getOptionCode(select, option, optionClone) {
      optionClone.setAttribute('data-value', option.value);
      if(option.selected) {
        optionClone.setAttribute('aria-selected', 'true');
        optionClone.setAttribute('tabindex', '0');
      } else {
        optionClone.removeAttribute('aria-selected');
        optionClone.removeAttribute('tabindex');
      }
      var optionHtml = optionClone.outerHTML;
      optionHtml = optionHtml.replace('{option-label}', option.text);
      for(var i = 0; i < select.optionData.length; i++) {
        optionHtml = optionHtml.replace('{'+select.optionData[i]+'}', option.getAttribute('data-'+select.optionData[i]));
      }
      return optionHtml;
    };
  
    function updateTriggerLabel(select) {
      // select.triggerLabel.textContent = select.options[select.select.selectedIndex].text;
      select.triggerLabel.innerHTML = select.dropdown.querySelector('[aria-selected="true"]').innerHTML;
    };
  
    function triggerSelection(select, target) {
      var option = target.closest('[role="option"]');
      if(!option) return;
      selectOption(select, option);
    };
  
    function selectOption(select, option) {
      if(option.hasAttribute('aria-selected') && option.getAttribute('aria-selected') == 'true') {
        // selecting the same option
      } else { 
        var selectedOption = select.dropdown.querySelector('[aria-selected="true"]');
        if(selectedOption) {
          selectedOption.removeAttribute('aria-selected');
          selectedOption.removeAttribute('tabindex');
        }
        option.setAttribute('aria-selected', 'true');
        option.setAttribute('tabindex', '0');
        // new option has been selected -> update native <select> element and trigger label
        updateNativeSelect(select, option.getAttribute('data-value'));
        updateTriggerLabel(select);
      }
      // move focus back to trigger
      setTimeout(function(){
        select.trigger.click();
      });
    };
  
    function updateNativeSelect(select, selectedValue) {
      var selectedOption = select.select.querySelector('[value="'+selectedValue+'"');
      select.select.selectedIndex = Util.getIndexInArray(select.options, selectedOption);
      select.select.dispatchEvent(new CustomEvent('change', {bubbles: true})); // trigger change event
    };
  
    function keyboardCustomSelect(select, direction) {
      var selectedOption = select.select.querySelector('[value="'+document.activeElement.getAttribute('data-value')+'"]');
      if(!selectedOption) return;
      var index = Util.getIndexInArray(select.options, selectedOption);
      
      index = direction == 'next' ? index + 1 : index - 1;
      if(index < 0) return;
      if(index >= select.options.length) return;
      
      var dropdownOption = select.dropdown.querySelector('[data-value="'+select.options[index].getAttribute('value')+'"]');
      if(dropdownOption) Util.moveFocus(dropdownOption);
    };
  
    //initialize the AdvSelect objects
    var advSelect = document.getElementsByClassName('js-adv-select');
    if( advSelect.length > 0 ) {
      for( var i = 0; i < advSelect.length; i++) {
        (function(i){new AdvSelect(advSelect[i]);})(i);
      }
    }
  }());
// File#: _2_comments
// Usage: codyhouse.co/license
(function() {
    function initVote(element) {
      var voteCounter = element.getElementsByClassName('js-comments__vote-label');
      element.addEventListener('click', function(){
        var pressed = element.getAttribute('aria-pressed') == 'true';
        element.setAttribute('aria-pressed', !pressed);
        Util.toggleClass(element, 'comments__vote-btn--pressed', !pressed);
        resetCounter(voteCounter, pressed);
        emitKeypressEvents(element, voteCounter, pressed);
      });
    };
  
    function resetCounter(voteCounter, pressed) { // update counter value (if present)
      if(voteCounter.length == 0) return;
      var count = parseInt(voteCounter[0].textContent);
      voteCounter[0].textContent = pressed ? count - 1 : count + 1;
    };
  
    function emitKeypressEvents(element, label, pressed) { // emit custom event when vote is updated
      var count = (label.length == 0) ? false : parseInt(label[0].textContent);
      var event = new CustomEvent('newVote', {detail: {count: count, upVote: !pressed}});
      element.dispatchEvent(event);
    };
  
    var voteCounting = document.getElementsByClassName('js-comments__vote-btn');
    if( voteCounting.length > 0 ) {
      for( var i = 0; i < voteCounting.length; i++) {
        (function(i){initVote(voteCounting[i]);})(i);
      }
    }
  }());
// File#: _2_dropdown
// Usage: codyhouse.co/license
(function() {
    var Dropdown = function(element) {
      this.element = element;
      this.trigger = this.element.getElementsByClassName('js-dropdown__trigger')[0];
      this.dropdown = this.element.getElementsByClassName('js-dropdown__menu')[0];
      this.triggerFocus = false;
      this.dropdownFocus = false;
      this.hideInterval = false;
      // sublevels
      this.dropdownSubElements = this.element.getElementsByClassName('js-dropdown__sub-wrapper');
      this.prevFocus = false; // store element that was in focus before focus changed
      this.addDropdownEvents();
    };
    
    Dropdown.prototype.addDropdownEvents = function(){
      //place dropdown
      var self = this;
      this.placeElement();
      this.element.addEventListener('placeDropdown', function(event){
        self.placeElement();
      });
      // init dropdown
      this.initElementEvents(this.trigger, this.triggerFocus); // this is used to trigger the primary dropdown
      this.initElementEvents(this.dropdown, this.dropdownFocus); // this is used to trigger the primary dropdown
      // init sublevels
      this.initSublevels(); // if there are additional sublevels -> bind hover/focus events
    };
  
    Dropdown.prototype.placeElement = function() {
      // remove inline style first
      this.dropdown.removeAttribute('style');
      // check dropdown position
      var triggerPosition = this.trigger.getBoundingClientRect(),
        isRight = (window.innerWidth < triggerPosition.left + parseInt(getComputedStyle(this.dropdown).getPropertyValue('width')));
  
      var xPosition = isRight ? 'right: 0px; left: auto;' : 'left: 0px; right: auto;';
      this.dropdown.setAttribute('style', xPosition);
    };
  
    Dropdown.prototype.initElementEvents = function(element, bool) {
      var self = this;
      element.addEventListener('mouseenter', function(){
        bool = true;
        self.showDropdown();
      });
      element.addEventListener('focus', function(){
        self.showDropdown();
      });
      element.addEventListener('mouseleave', function(){
        bool = false;
        self.hideDropdown();
      });
      element.addEventListener('focusout', function(){
        self.hideDropdown();
      });
    };
  
    Dropdown.prototype.showDropdown = function(){
      if(this.hideInterval) clearInterval(this.hideInterval);
      // remove style attribute
      this.dropdown.removeAttribute('style');
      this.placeElement();
      this.showLevel(this.dropdown, true);
    };
  
    Dropdown.prototype.hideDropdown = function(){
      var self = this;
      if(this.hideInterval) clearInterval(this.hideInterval);
      this.hideInterval = setTimeout(function(){
        var dropDownFocus = document.activeElement.closest('.js-dropdown'),
          inFocus = dropDownFocus && (dropDownFocus == self.element);
        // if not in focus and not hover -> hide
        if(!self.triggerFocus && !self.dropdownFocus && !inFocus) {
          self.hideLevel(self.dropdown, true);
          // make sure to hide sub/dropdown
          self.hideSubLevels();
          self.prevFocus = false;
        }
      }, 300);
    };
  
    Dropdown.prototype.initSublevels = function(){
      var self = this;
      var dropdownMenu = this.element.getElementsByClassName('js-dropdown__menu');
      for(var i = 0; i < dropdownMenu.length; i++) {
        var listItems = dropdownMenu[i].children;
        // bind hover
        new menuAim({
          menu: dropdownMenu[i],
          activate: function(row) {
              var subList = row.getElementsByClassName('js-dropdown__menu')[0];
              if(!subList) return;
              Util.addClass(row.querySelector('a'), 'dropdown__item--hover');
              self.showLevel(subList);
          },
          deactivate: function(row) {
              var subList = row.getElementsByClassName('dropdown__menu')[0];
              if(!subList) return;
              Util.removeClass(row.querySelector('a'), 'dropdown__item--hover');
              self.hideLevel(subList);
          },
          submenuSelector: '.js-dropdown__sub-wrapper',
        });
      }
      // store focus element before change in focus
      this.element.addEventListener('keydown', function(event) { 
        if( event.keyCode && event.keyCode == 9 || event.key && event.key == 'Tab' ) {
          self.prevFocus = document.activeElement;
        }
      });
      // make sure that sublevel are visible when their items are in focus
      this.element.addEventListener('keyup', function(event) {
        if( event.keyCode && event.keyCode == 9 || event.key && event.key == 'Tab' ) {
          // focus has been moved -> make sure the proper classes are added to subnavigation
          var focusElement = document.activeElement,
            focusElementParent = focusElement.closest('.js-dropdown__menu'),
            focusElementSibling = focusElement.nextElementSibling;
  
          // if item in focus is inside submenu -> make sure it is visible
          if(focusElementParent && !Util.hasClass(focusElementParent, 'dropdown__menu--is-visible')) {
            self.showLevel(focusElementParent);
          }
          // if item in focus triggers a submenu -> make sure it is visible
          if(focusElementSibling && !Util.hasClass(focusElementSibling, 'dropdown__menu--is-visible')) {
            self.showLevel(focusElementSibling);
          }
  
          // check previous element in focus -> hide sublevel if required 
          if( !self.prevFocus) return;
          var prevFocusElementParent = self.prevFocus.closest('.js-dropdown__menu'),
            prevFocusElementSibling = self.prevFocus.nextElementSibling;
          
          if( !prevFocusElementParent ) return;
          
          // element in focus and element prev in focus are siblings
          if( focusElementParent && focusElementParent == prevFocusElementParent) {
            if(prevFocusElementSibling) self.hideLevel(prevFocusElementSibling);
            return;
          }
  
          // element in focus is inside submenu triggered by element prev in focus
          if( prevFocusElementSibling && focusElementParent && focusElementParent == prevFocusElementSibling) return;
          
          // shift tab -> element in focus triggers the submenu of the element prev in focus
          if( focusElementSibling && prevFocusElementParent && focusElementSibling == prevFocusElementParent) return;
          
          var focusElementParentParent = focusElementParent.parentNode.closest('.js-dropdown__menu');
          
          // shift tab -> element in focus is inside the dropdown triggered by a siblings of the element prev in focus
          if(focusElementParentParent && focusElementParentParent == prevFocusElementParent) {
            if(prevFocusElementSibling) self.hideLevel(prevFocusElementSibling);
            return;
          }
          
          if(prevFocusElementParent && Util.hasClass(prevFocusElementParent, 'dropdown__menu--is-visible')) {
            self.hideLevel(prevFocusElementParent);
          }
        }
      });
    };
  
    Dropdown.prototype.hideSubLevels = function(){
      var visibleSubLevels = this.dropdown.getElementsByClassName('dropdown__menu--is-visible');
      if(visibleSubLevels.length == 0) return;
      while (visibleSubLevels[0]) {
        this.hideLevel(visibleSubLevels[0]);
         }
         var hoveredItems = this.dropdown.getElementsByClassName('dropdown__item--hover');
         while (hoveredItems[0]) {
        Util.removeClass(hoveredItems[0], 'dropdown__item--hover');
         }
    };
  
    Dropdown.prototype.showLevel = function(level, bool){
      if(bool == undefined) {
        //check if the sublevel needs to be open to the left
        Util.removeClass(level, 'dropdown__menu--left');
        var boundingRect = level.getBoundingClientRect();
        if(window.innerWidth - boundingRect.right < 5 && boundingRect.left + window.scrollX > 2*boundingRect.width) Util.addClass(level, 'dropdown__menu--left');
      }
      Util.addClass(level, 'dropdown__menu--is-visible');
      Util.removeClass(level, 'dropdown__menu--is-hidden');
    };
  
    Dropdown.prototype.hideLevel = function(level, bool){
      if(!Util.hasClass(level, 'dropdown__menu--is-visible')) return;
      Util.removeClass(level, 'dropdown__menu--is-visible');
      Util.addClass(level, 'dropdown__menu--is-hidden');
      
      level.addEventListener('transitionend', function cb(event){
        if(event.propertyName != 'opacity') return;
        level.removeEventListener('transitionend', cb);
        if(Util.hasClass(level, 'dropdown__menu--is-hidden')) Util.removeClass(level, 'dropdown__menu--is-hidden dropdown__menu--left');
        if(bool && !Util.hasClass(level, 'dropdown__menu--is-visible')) level.setAttribute('style', 'width: 0px; overflow: hidden;');
      });
    };
  
    window.Dropdown = Dropdown;
  
    var dropdown = document.getElementsByClassName('js-dropdown');
    if( dropdown.length > 0 ) { // init Dropdown objects
      for( var i = 0; i < dropdown.length; i++) {
        (function(i){new Dropdown(dropdown[i]);})(i);
      }
    }
  }());
// File#: _2_flexi-header
// Usage: codyhouse.co/license
(function() {
    var flexHeader = document.getElementsByClassName('js-f-header');
    if(flexHeader.length > 0) {
      var menuTrigger = flexHeader[0].getElementsByClassName('js-anim-menu-btn')[0],
        firstFocusableElement = getMenuFirstFocusable();
  
      // we'll use these to store the node that needs to receive focus when the mobile menu is closed 
      var focusMenu = false;
  
      resetFlexHeaderOffset();
      setAriaButtons();
  
      menuTrigger.addEventListener('anim-menu-btn-clicked', function(event){
        toggleMenuNavigation(event.detail);
      });
  
      // listen for key events
      window.addEventListener('keyup', function(event){
        // listen for esc key
        if( (event.keyCode && event.keyCode == 27) || (event.key && event.key.toLowerCase() == 'escape' )) {
          // close navigation on mobile if open
          if(menuTrigger.getAttribute('aria-expanded') == 'true' && isVisible(menuTrigger)) {
            focusMenu = menuTrigger; // move focus to menu trigger when menu is close
            menuTrigger.click();
          }
        }
        // listen for tab key
        if( (event.keyCode && event.keyCode == 9) || (event.key && event.key.toLowerCase() == 'tab' )) {
          // close navigation on mobile if open when nav loses focus
          if(menuTrigger.getAttribute('aria-expanded') == 'true' && isVisible(menuTrigger) && !document.activeElement.closest('.js-f-header')) menuTrigger.click();
        }
      });
  
      // detect click on a dropdown control button - expand-on-mobile only
      flexHeader[0].addEventListener('click', function(event){
        var btnLink = event.target.closest('.js-f-header__dropdown-control');
        if(!btnLink) return;
        !btnLink.getAttribute('aria-expanded') ? btnLink.setAttribute('aria-expanded', 'true') : btnLink.removeAttribute('aria-expanded');
      });
  
      // detect mouseout from a dropdown control button - expand-on-mobile only
      flexHeader[0].addEventListener('mouseout', function(event){
        var btnLink = event.target.closest('.js-f-header__dropdown-control');
        if(!btnLink) return;
        // check layout type
        if(getLayout() == 'mobile') return;
        btnLink.removeAttribute('aria-expanded');
      });
  
      // close dropdown on focusout - expand-on-mobile only
      flexHeader[0].addEventListener('focusin', function(event){
        var btnLink = event.target.closest('.js-f-header__dropdown-control'),
          dropdown = event.target.closest('.f-header__dropdown');
        if(dropdown) return;
        if(btnLink && btnLink.hasAttribute('aria-expanded')) return;
        // check layout type
        if(getLayout() == 'mobile') return;
        var openDropdown = flexHeader[0].querySelector('.js-f-header__dropdown-control[aria-expanded="true"]');
        if(openDropdown) openDropdown.removeAttribute('aria-expanded');
      });
  
      // listen for resize
      var resizingId = false;
      window.addEventListener('resize', function() {
        clearTimeout(resizingId);
        resizingId = setTimeout(doneResizing, 500);
      });
  
      function getMenuFirstFocusable() {
        var focusableEle = flexHeader[0].getElementsByClassName('f-header__nav')[0].querySelectorAll('[href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), button:not([disabled]), iframe, object, embed, [tabindex]:not([tabindex="-1"]), [contenteditable], audio[controls], video[controls], summary'),
          firstFocusable = false;
        for(var i = 0; i < focusableEle.length; i++) {
          if( focusableEle[i].offsetWidth || focusableEle[i].offsetHeight || focusableEle[i].getClientRects().length ) {
            firstFocusable = focusableEle[i];
            break;
          }
        }
  
        return firstFocusable;
      };
      
      function isVisible(element) {
        return (element.offsetWidth || element.offsetHeight || element.getClientRects().length);
      };
  
      function doneResizing() {
        if( !isVisible(menuTrigger) && Util.hasClass(flexHeader[0], 'f-header--expanded')) {
          menuTrigger.click();
        }
        resetFlexHeaderOffset();
      };
      
      function toggleMenuNavigation(bool) { // toggle menu visibility on small devices
        Util.toggleClass(document.getElementsByClassName('f-header__nav')[0], 'f-header__nav--is-visible', bool);
        Util.toggleClass(flexHeader[0], 'f-header--expanded', bool);
        menuTrigger.setAttribute('aria-expanded', bool);
        if(bool) firstFocusableElement.focus(); // move focus to first focusable element
        else if(focusMenu) {
          focusMenu.focus();
          focusMenu = false;
        }
      };
  
      function resetFlexHeaderOffset() {
        // on mobile -> update max height of the flexi header based on its offset value (e.g., if there's a fixed pre-header element)
        document.documentElement.style.setProperty('--f-header-offset', flexHeader[0].getBoundingClientRect().top+'px');
      };
  
      function setAriaButtons() {
        var btnDropdown = flexHeader[0].getElementsByClassName('js-f-header__dropdown-control');
        for(var i = 0; i < btnDropdown.length; i++) {
          var id = 'f-header-dropdown-'+i,
            dropdown = btnDropdown[i].nextElementSibling;
          if(dropdown.hasAttribute('id')) {
            id = dropdown.getAttribute('id');
          } else {
            dropdown.setAttribute('id', id);
          }
          btnDropdown[i].setAttribute('aria-controls', id);	
        }
      };
  
      function getLayout() {
        return getComputedStyle(flexHeader[0], ':before').getPropertyValue('content').replace(/\'|"/g, '');
      };
    }
  }());
// File#: _2_menu-bar
// Usage: codyhouse.co/license
(function() {
    var MenuBar = function(element) {
      this.element = element;
      this.items = Util.getChildrenByClassName(this.element, 'menu-bar__item');
      this.mobHideItems = this.element.getElementsByClassName('menu-bar__item--hide');
      this.moreItemsTrigger = this.element.getElementsByClassName('js-menu-bar__trigger');
      initMenuBar(this);
    };
  
    function initMenuBar(menu) {
      setMenuTabIndex(menu); // set correct tabindexes for menu item
      initMenuBarMarkup(menu); // create additional markup
      checkMenuLayout(menu); // set menu layout
      Util.addClass(menu.element, 'menu-bar--loaded'); // reveal menu
  
      // custom event emitted when window is resized
      menu.element.addEventListener('update-menu-bar', function(event){
        checkMenuLayout(menu);
        if(menu.menuInstance) menu.menuInstance.toggleMenu(false, false); // close dropdown
      });
  
      // keyboard events 
      // open dropdown when pressing Enter on trigger element
      if(menu.moreItemsTrigger.length > 0) {
        menu.moreItemsTrigger[0].addEventListener('keydown', function(event) {
          if( (event.keyCode && event.keyCode == 13) || (event.key && event.key.toLowerCase() == 'enter') ) {
            if(!menu.menuInstance) return;
            menu.menuInstance.selectedTrigger = menu.moreItemsTrigger[0];
            menu.menuInstance.toggleMenu(!Util.hasClass(menu.subMenu, 'menu--is-visible'), true);
          }
        });
  
        // close dropdown on esc
        menu.subMenu.addEventListener('keydown', function(event) {
          if((event.keyCode && event.keyCode == 27) || (event.key && event.key.toLowerCase() == 'escape')) { // close submenu on esc
            if(menu.menuInstance) menu.menuInstance.toggleMenu(false, true);
          }
        });
      }
      
      // navigate menu items using left/right arrows
      menu.element.addEventListener('keydown', function(event) {
        if( (event.keyCode && event.keyCode == 39) || (event.key && event.key.toLowerCase() == 'arrowright') ) {
          navigateItems(menu.items, event, 'next');
        } else if( (event.keyCode && event.keyCode == 37) || (event.key && event.key.toLowerCase() == 'arrowleft') ) {
          navigateItems(menu.items, event, 'prev');
        }
      });
    };
  
    function setMenuTabIndex(menu) { // set tabindexes for the menu items to allow keyboard navigation
      var nextItem = false;
      for(var i = 0; i < menu.items.length; i++ ) {
        if(i == 0 || nextItem) menu.items[i].setAttribute('tabindex', '0');
        else menu.items[i].setAttribute('tabindex', '-1');
        if(i == 0 && menu.moreItemsTrigger.length > 0) nextItem = true;
        else nextItem = false;
      }
    };
  
    function initMenuBarMarkup(menu) {
      if(menu.mobHideItems.length == 0 ) { // no items to hide on mobile - remove trigger
        if(menu.moreItemsTrigger.length > 0) menu.element.removeChild(menu.moreItemsTrigger[0]);
        return;
      }
  
      if(menu.moreItemsTrigger.length == 0) return;
  
      // create the markup for the Menu element
      var content = '';
      menu.menuControlId = 'submenu-bar-'+Date.now();
      for(var i = 0; i < menu.mobHideItems.length; i++) {
        var item = menu.mobHideItems[i].cloneNode(true),
          svg = item.getElementsByTagName('svg')[0],
          label = item.getElementsByClassName('menu-bar__label')[0];
  
        svg.setAttribute('class', 'icon menu__icon');
        content = content + '<li role="menuitem"><span class="menu__content js-menu__content">'+svg.outerHTML+'<span>'+label.innerHTML+'</span></span></li>';
      }
  
      Util.setAttributes(menu.moreItemsTrigger[0], {'role': 'button', 'aria-expanded': 'false', 'aria-controls': menu.menuControlId, 'aria-haspopup': 'true'});
  
      var subMenu = document.createElement('menu'),
        customClass = menu.element.getAttribute('data-menu-class');
      Util.setAttributes(subMenu, {'id': menu.menuControlId, 'class': 'menu js-menu '+customClass});
      subMenu.innerHTML = content;
      document.body.appendChild(subMenu);
  
      menu.subMenu = subMenu;
      menu.subItems = subMenu.getElementsByTagName('li');
  
      menu.menuInstance = new Menu(menu.subMenu); // this will handle the dropdown behaviour
    };
  
    function checkMenuLayout(menu) { // switch from compressed to expanded layout and viceversa
      var layout = getComputedStyle(menu.element, ':before').getPropertyValue('content').replace(/\'|"/g, '');
      Util.toggleClass(menu.element, 'menu-bar--collapsed', layout == 'collapsed');
    };
  
    function navigateItems(list, event, direction, prevIndex) { // keyboard navigation among menu items
      event.preventDefault();
      var index = (typeof prevIndex !== 'undefined') ? prevIndex : Util.getIndexInArray(list, event.target),
        nextIndex = direction == 'next' ? index + 1 : index - 1;
      if(nextIndex < 0) nextIndex = list.length - 1;
      if(nextIndex > list.length - 1) nextIndex = 0;
      // check if element is visible before moving focus
      (list[nextIndex].offsetParent === null) ? navigateItems(list, event, direction, nextIndex) : Util.moveFocus(list[nextIndex]);
    };
  
    function checkMenuClick(menu, target) { // close dropdown when clicking outside the menu element
      if(menu.menuInstance && !menu.moreItemsTrigger[0].contains(target) && !menu.subMenu.contains(target)) menu.menuInstance.toggleMenu(false, false);
    };
  
    // init MenuBars objects
    var menuBars = document.getElementsByClassName('js-menu-bar');
    if( menuBars.length > 0 ) {
      var j = 0,
        menuBarArray = [];
      for( var i = 0; i < menuBars.length; i++) {
        var beforeContent = getComputedStyle(menuBars[i], ':before').getPropertyValue('content');
        if(beforeContent && beforeContent !='' && beforeContent !='none') {
          (function(i){menuBarArray.push(new MenuBar(menuBars[i]));})(i);
          j = j + 1;
        }
      }
      
      if(j > 0) {
        var resizingId = false,
          customEvent = new CustomEvent('update-menu-bar');
        // update Menu Bar layout on resize  
        window.addEventListener('resize', function(event){
          clearTimeout(resizingId);
          resizingId = setTimeout(doneResizing, 150);
        });
  
        // close menu when clicking outside it
        window.addEventListener('click', function(event){
          menuBarArray.forEach(function(element){
            checkMenuClick(element, event.target);
          });
        });
  
        function doneResizing() {
          for( var i = 0; i < menuBars.length; i++) {
            (function(i){menuBars[i].dispatchEvent(customEvent)})(i);
          };
        };
      }
    }
  }());
// File#: _2_table-of-contents
// Usage: codyhouse.co/license
(function() {
    var Toc = function(element) {
      this.element = element;
      this.list = this.element.getElementsByClassName('js-toc__list')[0];
      this.anchors = this.list.querySelectorAll('a[href^="#"]');
      this.sections = getSections(this);
      this.controller = this.element.getElementsByClassName('js-toc__control');
      this.controllerLabel = this.element.getElementsByClassName('js-toc__control-label');
      this.content = getTocContent(this);
      this.clickScrolling = false;
      this.intervalID = false;
      this.staticLayoutClass = 'toc--static';
      this.contentStaticLayoutClass = 'toc-content--toc-static';
      this.expandedClass = 'toc--expanded';
      this.isStatic = Util.hasClass(this.element, this.staticLayoutClass);
      this.layout = 'static';
      initToc(this);
    };
  
    function getSections(toc) {
      var sections = [];
      // get all content sections
      for(var i = 0; i < toc.anchors.length; i++) {
        var section = document.getElementById(toc.anchors[i].getAttribute('href').replace('#', ''));
        if(section) sections.push(section);
      }
      return sections;
    };
  
    function getTocContent(toc) {
      if(toc.sections.length < 1) return false;
      var content = toc.sections[0].closest('.js-toc-content');
      return content;
    };
  
    function initToc(toc) {
      checkTocLayour(toc); // switch between mobile and desktop layout
      if(toc.sections.length > 0) {
        // listen for click on anchors
        toc.list.addEventListener('click', function(event){
          var anchor = event.target.closest('a[href^="#"]');
          if(!anchor) return;
          // reset link apperance 
          toc.clickScrolling = true;
          resetAnchors(toc, anchor);
          // close toc if expanded on mobile
          toggleToc(toc, true);
        });
  
        // check when a new section enters the viewport
        var intersectionObserverSupported = ('IntersectionObserver' in window && 'IntersectionObserverEntry' in window && 'intersectionRatio' in window.IntersectionObserverEntry.prototype);
        if(intersectionObserverSupported) {
          var observer = new IntersectionObserver(
            function(entries, observer) { 
              entries.forEach(function(entry){
                if(!toc.clickScrolling) { // do not update classes if user clicked on a link
                  getVisibleSection(toc);
                }
              });
            }, 
            {
              threshold: [0, 0.1],
              rootMargin: "0px 0px -70% 0px"
            }
          );
  
          for(var i = 0; i < toc.sections.length; i++) {
            observer.observe(toc.sections[i]);
          }
        }
  
        // detect the end of scrolling -> reactivate IntersectionObserver on scroll
        toc.element.addEventListener('toc-scroll', function(event){
          toc.clickScrolling = false;
        });
      }
  
      // custom event emitted when window is resized
      toc.element.addEventListener('toc-resize', function(event){
        checkTocLayour(toc);
      });
  
      // collapsed version only (mobile)
      initCollapsedVersion(toc);
    };
  
    function resetAnchors(toc, anchor) {
      if(!anchor) return;
      for(var i = 0; i < toc.anchors.length; i++) Util.removeClass(toc.anchors[i], 'toc__link--selected');
      Util.addClass(anchor, 'toc__link--selected');
    };
  
    function getVisibleSection(toc) {
      if(toc.intervalID) {
        clearInterval(toc.intervalID);
      }
      toc.intervalID = setTimeout(function(){
        var halfWindowHeight = window.innerHeight/2,
        index = -1;
        for(var i = 0; i < toc.sections.length; i++) {
          var top = toc.sections[i].getBoundingClientRect().top;
          if(top < halfWindowHeight) index = i;
        }
        if(index > -1) {
          resetAnchors(toc, toc.anchors[index]);
        }
        toc.intervalID = false;
      }, 100);
    };
  
    function checkTocLayour(toc) {
      if(toc.isStatic) return;
      toc.layout = getComputedStyle(toc.element, ':before').getPropertyValue('content').replace(/\'|"/g, '');
      Util.toggleClass(toc.element, toc.staticLayoutClass, toc.layout == 'static');
      if(toc.content) Util.toggleClass(toc.content, toc.contentStaticLayoutClass, toc.layout == 'static');
    };
  
    function initCollapsedVersion(toc) { // collapsed version only (mobile)
      if(toc.controller.length < 1) return;
      
      // toggle nav visibility
      toc.controller[0].addEventListener('click', function(event){
        var isOpen = Util.hasClass(toc.element, toc.expandedClass);
        toggleToc(toc, isOpen);
      });
  
      // close expanded version on esc
      toc.element.addEventListener('keydown', function(event){
        if(toc.layout == 'static') return;
        if( (event.keyCode && event.keyCode == 27) || (event.key && event.key.toLowerCase() == 'escape') ) {
          toggleToc(toc, true);
          toc.controller[0].focus();
        }
      });
    };
  
    function toggleToc(toc, bool) { // collapsed version only (mobile)
      // toggle mobile version
      Util.toggleClass(toc.element, toc.expandedClass, !bool);
      bool ? toc.controller[0].removeAttribute('aria-expanded') : toc.controller[0].setAttribute('aria-expanded', 'true');
      if(!bool && toc.anchors.length > 0) {
        toc.anchors[0].focus();
      }
    };
    
    var tocs = document.getElementsByClassName('js-toc');
  
    var tocsArray = [];
    if( tocs.length > 0) {
      for( var i = 0; i < tocs.length; i++) {
        (function(i){ tocsArray.push(new Toc(tocs[i])); })(i);
      }
  
      // listen to window scroll -> reset clickScrolling property
      var scrollId = false,
        resizeId = false,
        scrollEvent = new CustomEvent('toc-scroll'),
        resizeEvent = new CustomEvent('toc-resize');
        
      window.addEventListener('scroll', function() {
        clearTimeout(scrollId);
        scrollId = setTimeout(doneScrolling, 100);
      });
  
      window.addEventListener('resize', function() {
        clearTimeout(resizeId);
        scrollId = setTimeout(doneResizing, 100);
      });
  
      function doneScrolling() {
        for( var i = 0; i < tocsArray.length; i++) {
          (function(i){tocsArray[i].element.dispatchEvent(scrollEvent)})(i);
        };
      };
  
      function doneResizing() {
        for( var i = 0; i < tocsArray.length; i++) {
          (function(i){tocsArray[i].element.dispatchEvent(resizeEvent)})(i);
        };
      };
    }
  }());

// File#: _3_interactive-table
// Usage: codyhouse.co/license
(function() {
    var IntTable = function(element) {
      this.element = element;
      this.header = this.element.getElementsByClassName('js-int-table__header')[0];
      this.headerCols = this.header.getElementsByTagName('tr')[0].children;
      this.body = this.element.getElementsByClassName('js-int-table__body')[0];
      this.sortingRows = this.element.getElementsByClassName('js-int-table__sort-row');
      initIntTable(this);
    };
  
    function initIntTable(table) {
      // check if table has actions
      initIntTableActions(table);
      // check if there are checkboxes to select/deselect a row/all rows
      var selectAll = table.element.getElementsByClassName('js-int-table__select-all');
      if(selectAll.length > 0) initIntTableSelection(table, selectAll);
      // check if there are sortable columns
      table.sortableCols = table.element.getElementsByClassName('js-int-table__cell--sort');
      if(table.sortableCols.length > 0) {
        // add a data-order attribute to all rows so that we can reset the order
        setDataRowOrder(table);
        // listen to the click event on a sortable column
        table.header.addEventListener('click', function(event){
          var selectedCol = event.target.closest('.js-int-table__cell--sort');
          if(!selectedCol || event.target.tagName.toLowerCase() == 'input') return;
          sortColumns(table, selectedCol);
        });
        table.header.addEventListener('change', function(event){ // detect change in selected checkbox (SR only)
          var selectedCol = event.target.closest('.js-int-table__cell--sort');
          if(!selectedCol) return;
          sortColumns(table, selectedCol, event.target.value);
        });
        table.header.addEventListener('keydown', function(event){ // keyboard navigation - change sorting on enter
          if( event.keyCode && event.keyCode == 13 || event.key && event.key.toLowerCase() == 'enter') {
            var selectedCol = event.target.closest('.js-int-table__cell--sort');
            if(!selectedCol) return;
            sortColumns(table, selectedCol);
          }
        });
  
        // change cell style when in focus
        table.header.addEventListener('focusin', function(event){
          var closestCell = document.activeElement.closest('.js-int-table__cell--sort');
          if(closestCell) Util.addClass(closestCell, 'int-table__cell--focus');
        });
        table.header.addEventListener('focusout', function(event){
          for(var i = 0; i < table.sortableCols.length; i++) {
            Util.removeClass(table.sortableCols[i], 'int-table__cell--focus');
          }
        });
      }
    };
  
    function initIntTableActions(table) {
      // check if table has actions and store them
      var tableId = table.element.getAttribute('id');
      if(!tableId) return;
      var tableActions = document.querySelector('[data-table-controls="'+tableId+'"]');
      if(!tableActions) return;
      table.actionsSelection = tableActions.getElementsByClassName('js-int-table-actions__items-selected');
      table.actionsNoSelection = tableActions.getElementsByClassName('js-int-table-actions__no-items-selected');
    };
  
    function initIntTableSelection(table, select) { // checkboxes for rows selection
      table.selectAll = select[0];
      table.selectRow = table.element.getElementsByClassName('js-int-table__select-row');
      // select/deselect all rows
      table.selectAll.addEventListener('click', function(event){ // we cannot use the 'change' event as on IE/Edge the change from "indeterminate" to either "checked" or "unchecked"  does not trigger that event
        toggleRowSelection(table);
      });
      // select/deselect single row - reset all row selector 
      table.body.addEventListener('change', function(event){
        if(!event.target.closest('.js-int-table__select-row')) return;
        toggleAllSelection(table);
      });
      // toggle actions
      toggleActions(table, table.element.getElementsByClassName('int-table__row--checked').length > 0);
    };
  
    function toggleRowSelection(table) { // 'Select All Rows' checkbox has been selected/deselected
      var status = table.selectAll.checked;
      for(var i = 0; i < table.selectRow.length; i++) {
        table.selectRow[i].checked = status;
        Util.toggleClass(table.selectRow[i].closest('.int-table__row'), 'int-table__row--checked', status);
      }
      toggleActions(table, status);
    };
  
    function toggleAllSelection(table) { // Single row has been selected/deselected
      var allChecked = true,
        oneChecked = false;
      for(var i = 0; i < table.selectRow.length; i++) {
        if(!table.selectRow[i].checked) {allChecked = false;}
        else {oneChecked = true;}
        Util.toggleClass(table.selectRow[i].closest('.int-table__row'), 'int-table__row--checked', table.selectRow[i].checked);
      }
      table.selectAll.checked = oneChecked;
      // if status if false but one input is checked -> set an indeterminate state for the 'Select All' checkbox
      if(!allChecked) {
        table.selectAll.indeterminate = oneChecked;
      } else if(allChecked && oneChecked) {
        table.selectAll.indeterminate = false;
      }
      toggleActions(table, oneChecked);
    };
  
    function setDataRowOrder(table) { // add a data-order to rows element - will be used when resetting the sorting 
      var rowsArray = table.body.getElementsByTagName('tr');
      for(var i = 0; i < rowsArray.length; i++) {
        rowsArray[i].setAttribute('data-order', i);
      }
    };
  
    function sortColumns(table, selectedCol, customOrder) {
      // determine sorting order (asc/desc/reset)
      var order = customOrder || getSortingOrder(selectedCol),
        colIndex = Util.getIndexInArray(table.headerCols, selectedCol);
      // sort table
      sortTableContent(table, order, colIndex, selectedCol);
      
      // reset appearance of the th column that was previously sorted (if any) 
      for(var i = 0; i < table.headerCols.length; i++) {
        Util.removeClass(table.headerCols[i], 'int-table__cell--asc int-table__cell--desc');
      }
      // reset appearance for the selected th column
      if(order == 'asc') Util.addClass(selectedCol, 'int-table__cell--asc');
      if(order == 'desc') Util.addClass(selectedCol, 'int-table__cell--desc');
      // reset checkbox selection
      if(!customOrder) selectedCol.querySelector('input[value="'+order+'"]').checked = true;
    };
  
    function getSortingOrder(selectedCol) { // determine sorting order
      if( Util.hasClass(selectedCol, 'int-table__cell--asc') ) return 'desc';
      if( Util.hasClass(selectedCol, 'int-table__cell--desc') ) return 'none';
      return 'asc';
    };
  
    function sortTableContent(table, order, index, selctedCol) { // determine the new order of the rows
      var rowsArray = table.body.getElementsByTagName('tr'),
        switching = true,
        i = 0,
        shouldSwitch;
      while (switching) {
        switching = false;
        for (i = 0; i < rowsArray.length - 1; i++) {
          var contentOne = (order == 'none') ? rowsArray[i].getAttribute('data-order') : rowsArray[i].children[index].textContent.trim(),
            contentTwo = (order == 'none') ? rowsArray[i+1].getAttribute('data-order') : rowsArray[i+1].children[index].textContent.trim();
  
          shouldSwitch = compareValues(contentOne, contentTwo, order, selctedCol);
          if(shouldSwitch) {
            table.body.insertBefore(rowsArray[i+1], rowsArray[i]);
            switching = true;
            break;
          }
        }
      }
    };
  
    function compareValues(val1, val2, order, selctedCol) {
      var compare,
        dateComparison = selctedCol.getAttribute('data-date-format');
      if( dateComparison && order != 'none') { // comparing dates
        compare =  (order == 'asc' || order == 'none') ? parseCustomDate(val1, dateComparison) > parseCustomDate(val2, dateComparison) : parseCustomDate(val2, dateComparison) > parseCustomDate(val1, dateComparison);
      } else if( !isNaN(val1) && !isNaN(val2) ) { // comparing numbers
        compare =  (order == 'asc' || order == 'none') ? Number(val1) > Number(val2) : Number(val2) > Number(val1);
      } else { // comparing strings
        compare =  (order == 'asc' || order == 'none') 
          ? val2.toString().localeCompare(val1) < 0
          : val1.toString().localeCompare(val2) < 0;
      }
      return compare;
    };
  
    function parseCustomDate(date, format) {
      var parts = date.match(/(\d+)/g), 
        i = 0, fmt = {};
      // extract date-part indexes from the format
      format.replace(/(yyyy|dd|mm)/g, function(part) { fmt[part] = i++; });
  
      return new Date(parts[fmt['yyyy']], parts[fmt['mm']]-1, parts[fmt['dd']]);
    };
  
    function toggleActions(table, selection) {
      if(table.actionsSelection && table.actionsSelection.length > 0) {
        Util.toggleClass(table.actionsSelection[0], 'is-hidden', !selection);
      }
      if(table.actionsNoSelection && table.actionsNoSelection.length > 0) {
        Util.toggleClass(table.actionsNoSelection[0], 'is-hidden', selection);
      }
    };
  
    //initialize the IntTable objects
    var intTable = document.getElementsByClassName('js-int-table');
    if( intTable.length > 0 ) {
      for( var i = 0; i < intTable.length; i++) {
        (function(i){new IntTable(intTable[i]);})(i);
      }
    }
  }());
// File#: _3_main-header-v2
// Usage: codyhouse.co/license
(function() {
    var Submenu = function(element) {
      this.element = element;
      this.trigger = this.element.getElementsByClassName('header-v2__nav-link')[0];
      this.dropdown = this.element.getElementsByClassName('header-v2__nav-dropdown')[0];
      this.triggerFocus = false;
      this.dropdownFocus = false;
      this.hideInterval = false;
      this.prevFocus = false; // nested dropdown - store element that was in focus before focus changed
      initSubmenu(this);
      initNestedDropdown(this);
    };
  
    function initSubmenu(list) {
      initElementEvents(list, list.trigger);
      initElementEvents(list, list.dropdown);
    };
  
    function initElementEvents(list, element, bool) {
      element.addEventListener('focus', function(){
        bool = true;
        showDropdown(list);
      });
      element.addEventListener('focusout', function(event){
        bool = false;
        hideDropdown(list, event);
      });
    };
  
    function showDropdown(list) {
      if(list.hideInterval) clearInterval(list.hideInterval);
      Util.addClass(list.dropdown, 'header-v2__nav-list--is-visible');
      resetDropdownStyle(list.dropdown, true);
    };
  
    function hideDropdown(list, event) {
      if(list.hideInterval) clearInterval(this.hideInterval);
      list.hideInterval = setTimeout(function(){
        var submenuFocus = document.activeElement.closest('.header-v2__nav-item--main'),
          inFocus = submenuFocus && (submenuFocus == list.element);
        if(!list.triggerFocus && !list.dropdownFocus && !inFocus) { // hide if focus is outside submenu
          Util.removeClass(list.dropdown, 'header-v2__nav-list--is-visible');
          resetDropdownStyle(list.dropdown, false);
          hideSubLevels(list);
          list.prevFocus = false;
        }
      }, 100);
    };
  
    function initNestedDropdown(list) {
      var dropdownMenu = list.element.getElementsByClassName('header-v2__nav-list');
      for(var i = 0; i < dropdownMenu.length; i++) {
        var listItems = dropdownMenu[i].children;
        // bind hover
        new menuAim({
          menu: dropdownMenu[i],
          activate: function(row) {
              var subList = row.getElementsByClassName('header-v2__nav-dropdown')[0];
              if(!subList) return;
              Util.addClass(row.querySelector('a.header-v2__nav-link'), 'header-v2__nav-link--hover');
              showLevel(list, subList);
          },
          deactivate: function(row) {
              var subList = row.getElementsByClassName('header-v2__nav-dropdown')[0];
              if(!subList) return;
              Util.removeClass(row.querySelector('a.header-v2__nav-link'), 'header-v2__nav-link--hover');
              hideLevel(list, subList);
          },
          exitMenu: function() {
            return true;
          },
          submenuSelector: '.header-v2__nav-item--has-children',
        });
      }
      // store focus element before change in focus
      list.element.addEventListener('keydown', function(event) { 
        if( event.keyCode && event.keyCode == 9 || event.key && event.key == 'Tab' ) {
          list.prevFocus = document.activeElement;
        }
      });
      // make sure that sublevel are visible when their items are in focus
      list.element.addEventListener('keyup', function(event) {
        if( event.keyCode && event.keyCode == 9 || event.key && event.key == 'Tab' ) {
          // focus has been moved -> make sure the proper classes are added to subnavigation
          var focusElement = document.activeElement,
            focusElementParent = focusElement.closest('.header-v2__nav-dropdown'),
            focusElementSibling = focusElement.nextElementSibling;
  
          // if item in focus is inside submenu -> make sure it is visible
          if(focusElementParent && !Util.hasClass(focusElementParent, 'header-v2__nav-list--is-visible')) {
            showLevel(list, focusElementParent);
          }
          // if item in focus triggers a submenu -> make sure it is visible
          if(focusElementSibling && !Util.hasClass(focusElementSibling, 'header-v2__nav-list--is-visible')) {
            showLevel(list, focusElementSibling);
          }
  
          // check previous element in focus -> hide sublevel if required 
          if( !list.prevFocus) return;
          var prevFocusElementParent = list.prevFocus.closest('.header-v2__nav-dropdown'),
            prevFocusElementSibling = list.prevFocus.nextElementSibling;
          
          if( !prevFocusElementParent ) return;
          
          // element in focus and element prev in focus are siblings
          if( focusElementParent && focusElementParent == prevFocusElementParent) {
            if(prevFocusElementSibling) hideLevel(list, prevFocusElementSibling);
            return;
          }
  
          // element in focus is inside submenu triggered by element prev in focus
          if( prevFocusElementSibling && focusElementParent && focusElementParent == prevFocusElementSibling) return;
          
          // shift tab -> element in focus triggers the submenu of the element prev in focus
          if( focusElementSibling && prevFocusElementParent && focusElementSibling == prevFocusElementParent) return;
          
          var focusElementParentParent = focusElementParent.parentNode.closest('.header-v2__nav-dropdown');
          
          // shift tab -> element in focus is inside the dropdown triggered by a siblings of the element prev in focus
          if(focusElementParentParent && focusElementParentParent == prevFocusElementParent) {
            if(prevFocusElementSibling) hideLevel(list, prevFocusElementSibling);
            return;
          }
          
          if(prevFocusElementParent && Util.hasClass(prevFocusElementParent, 'header-v2__nav-list--is-visible')) {
            hideLevel(list, prevFocusElementParent);
          }
        }
      });
    };
  
    function hideSubLevels(list) {
      var visibleSubLevels = list.dropdown.getElementsByClassName('header-v2__nav-list--is-visible');
      if(visibleSubLevels.length == 0) return;
      while (visibleSubLevels[0]) {
        hideLevel(list, visibleSubLevels[0]);
         }
         var hoveredItems = list.dropdown.getElementsByClassName('header-v2__nav-link--hover');
         while (hoveredItems[0]) {
        Util.removeClass(hoveredItems[0], 'header-v2__nav-link--hover');
         }
    };
  
    function showLevel(list, level, bool) {
      if(bool == undefined) {
        //check if the sublevel needs to be open to the left
        Util.removeClass(level, 'header-v2__nav-dropdown--nested-left');
        var boundingRect = level.getBoundingClientRect();
        if(window.innerWidth - boundingRect.right < 5 && boundingRect.left + window.scrollX > 2*boundingRect.width) Util.addClass(level, 'header-v2__nav-dropdown--nested-left');
      }
      Util.addClass(level, 'header-v2__nav-list--is-visible');
    };
  
    function hideLevel(list, level) {
      if(!Util.hasClass(level, 'header-v2__nav-list--is-visible')) return;
      Util.removeClass(level, 'header-v2__nav-list--is-visible');
      
      level.addEventListener('transition', function cb(){
        level.removeEventListener('transition', cb);
        Util.removeClass(level, 'header-v2__nav-dropdown--nested-left');
      });
    };
  
    var mainHeader = document.getElementsByClassName('js-header-v2');
    if(mainHeader.length > 0) {
      var menuTrigger = mainHeader[0].getElementsByClassName('js-anim-menu-btn')[0],
        firstFocusableElement = getMenuFirstFocusable();
  
      // we'll use these to store the node that needs to receive focus when the mobile menu is closed 
      var focusMenu = false;
  
      menuTrigger.addEventListener('anim-menu-btn-clicked', function(event){ // toggle menu visibility an small devices
        Util.toggleClass(document.getElementsByClassName('header-v2__nav')[0], 'header-v2__nav--is-visible', event.detail);
        Util.toggleClass(mainHeader[0], 'header-v2--expanded', event.detail);
        menuTrigger.setAttribute('aria-expanded', event.detail);
        if(event.detail) firstFocusableElement.focus(); // move focus to first focusable element
        else if(focusMenu) {
          focusMenu.focus();
          focusMenu = false;
        }
      });
  
      // take care of submenu
      var mainList = mainHeader[0].getElementsByClassName('header-v2__nav-list--main');
      if(mainList.length > 0) {
        for( var i = 0; i < mainList.length; i++) {
          (function(i){
            new menuAim({ // use diagonal movement detection for main submenu
              menu: mainList[i],
              activate: function(row) {
                  var submenu = row.getElementsByClassName('header-v2__nav-dropdown');
                  if(submenu.length == 0 ) return;
                  Util.addClass(submenu[0], 'header-v2__nav-list--is-visible');
                  resetDropdownStyle(submenu[0], true);
              },
              deactivate: function(row) {
                  var submenu = row.getElementsByClassName('header-v2__nav-dropdown');
                  if(submenu.length == 0 ) return;
                  Util.removeClass(submenu[0], 'header-v2__nav-list--is-visible');
                  resetDropdownStyle(submenu[0], false);
              },
              exitMenu: function() {
                return true;
              },
              submenuSelector: '.header-v2__nav-item--has-children',
              submenuDirection: 'below'
            });
  
            // take care of focus event for main submenu
            var subMenu = mainList[i].getElementsByClassName('header-v2__nav-item--main');
            for(var j = 0; j < subMenu.length; j++) {(function(j){if(Util.hasClass(subMenu[j], 'header-v2__nav-item--has-children')) new Submenu(subMenu[j]);})(j);};
          })(i);
        }
      }
  
      // if data-animation-offset is set -> check scrolling
      var animateHeader = mainHeader[0].getAttribute('data-animation');
      if(animateHeader && animateHeader == 'on') {
        var scrolling = false,
          scrollOffset = (mainHeader[0].getAttribute('data-animation-offset')) ? parseInt(mainHeader[0].getAttribute('data-animation-offset')) : 400,
          mainHeaderHeight = mainHeader[0].offsetHeight,
          mainHeaderWrapper = mainHeader[0].getElementsByClassName('header-v2__wrapper')[0];
  
        window.addEventListener("scroll", function(event) {
          if( !scrolling ) {
            scrolling = true;
            (!window.requestAnimationFrame) ? setTimeout(function(){checkMainHeader();}, 250) : window.requestAnimationFrame(checkMainHeader);
          }
        });
  
        function checkMainHeader() {
          var windowTop = window.scrollY || document.documentElement.scrollTop;
          Util.toggleClass(mainHeaderWrapper, 'header-v2__wrapper--is-fixed', windowTop >= mainHeaderHeight);
          Util.toggleClass(mainHeaderWrapper, 'header-v2__wrapper--slides-down', windowTop >= scrollOffset);
          scrolling = false;
        };
      }
  
      // listen for key events
      window.addEventListener('keyup', function(event){
        // listen for esc key
        if( (event.keyCode && event.keyCode == 27) || (event.key && event.key.toLowerCase() == 'escape' )) {
          // close navigation on mobile if open
          if(menuTrigger.getAttribute('aria-expanded') == 'true' && isVisible(menuTrigger)) {
            focusMenu = menuTrigger; // move focus to menu trigger when menu is close
            menuTrigger.click();
          }
        }
        // listen for tab key
        if( (event.keyCode && event.keyCode == 9) || (event.key && event.key.toLowerCase() == 'tab' )) {
          // close navigation on mobile if open when nav loses focus
          if(menuTrigger.getAttribute('aria-expanded') == 'true' && isVisible(menuTrigger) && !document.activeElement.closest('.js-header-v2')) menuTrigger.click();
        }
      });
  
      // listen for resize
      var resizingId = false;
      window.addEventListener('resize', function() {
        clearTimeout(resizingId);
        resizingId = setTimeout(doneResizing, 500);
      });
  
      function doneResizing() {
        if( !isVisible(menuTrigger) && Util.hasClass(mainHeader[0], 'header-v2--expanded')) menuTrigger.click();
      };
  
      function getMenuFirstFocusable() {
        var focusableEle = mainHeader[0].getElementsByClassName('header-v2__nav')[0].querySelectorAll('[href], input:not([disabled]), select:not([disabled]), textarea:not([disabled]), button:not([disabled]), iframe, object, embed, [tabindex]:not([tabindex="-1"]), [contenteditable], audio[controls], video[controls], summary'),
          firstFocusable = false;
        for(var i = 0; i < focusableEle.length; i++) {
          if( focusableEle[i].offsetWidth || focusableEle[i].offsetHeight || focusableEle[i].getClientRects().length ) {
            firstFocusable = focusableEle[i];
            break;
          }
        }
  
        return firstFocusable;
      };
    }
  
    function resetDropdownStyle(dropdown, bool) {
      if(!bool) {
        dropdown.addEventListener('transitionend', function cb(){
          dropdown.removeAttribute('style');
          dropdown.removeEventListener('transitionend', cb);
        });
      } else {
        var boundingRect = dropdown.getBoundingClientRect();
        if(window.innerWidth - boundingRect.right < 5 && boundingRect.left + window.scrollX > 2*boundingRect.width) {
          var left = parseFloat(window.getComputedStyle(dropdown).getPropertyValue('left'));
          dropdown.style.left = (left + window.innerWidth - boundingRect.right - 5) + 'px';
        }
      }
    };
  
    function isVisible(element) {
      return (element.offsetWidth || element.offsetHeight || element.getClientRects().length);
    };
  }());