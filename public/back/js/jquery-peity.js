!function(t,i,e,n){var r=t.fn.peity=function(i,e){return l&&this.each(function(){var n=t(this),h=n.data("_peity");h?(i&&(h.type=i),t.extend(h.opts,e)):(h=new a(n,i,t.extend({},r.defaults[i],n.data("peity"),e)),n.change(function(){h.draw()}).data("_peity",h)),h.draw()}),this},a=function(t,i,e){this.$el=t,this.type=i,this.opts=e},h=a.prototype,s=h.svgElement=function(e,n){return t(i.createElementNS("http://www.w3.org/2000/svg",e)).attr(n)},l="createElementNS"in i&&s("svg",{})[0].createSVGRect;h.draw=function(){var t=this.opts;r.graphers[this.type].call(this,t),t.after&&t.after.call(this,t)},h.fill=function(){var i=this.opts.fill;return t.isFunction(i)?i:function(t,e){return i[e%i.length]}},h.prepare=function(t,i){return this.$svg||this.$el.hide().after(this.$svg=s("svg",{"class":"peity"})),this.$svg.empty().data("peity",this).attr({height:i,width:t})},h.values=function(){return t.map(this.$el.text().split(this.opts.delimiter),function(t){return parseFloat(t)})},r.defaults={},r.graphers={},r.register=function(t,i,e){this.defaults[t]=i,this.graphers[t]=e},r.register("pie",{fill:["#ff9900","#fff4dd","#ffc66e"],radius:8},function(i){if(!i.delimiter){var n=this.$el.text().match(/[^0-9\.]/);i.delimiter=n?n[0]:","}var r=t.map(this.values(),function(t){return t>0?t:0});if("/"==i.delimiter){var a=r[0],h=r[1];r=[a,e.max(0,h-a)]}for(var l=0,p=r.length,o=0;l<p;l++)o+=r[l];o||(p=2,o=1,r=[0,1]);var f=2*i.radius,c=this.prepare(i.width||f,i.height||f),u=c.width(),d=c.height(),g=u/2,m=d/2,v=e.min(g,m),y=i.innerRadius;"donut"!=this.type||y||(y=.5*v);var w=e.PI,x=this.fill(),k=this.scale=function(t,i){var n=t/o*w*2-w/2;return[i*e.cos(n)+g,i*e.sin(n)+m]},$=0;for(l=0;l<p;l++){var j,A=r[l],E=A/o;if(0!=E){if(1==E)if(y){var F=g-.01,M=m-v,S=m-y;j=s("path",{d:["M",g,M,"A",v,v,0,1,1,F,M,"L",F,S,"A",y,y,0,1,0,g,S].join(" ")})}else j=s("circle",{cx:g,cy:m,r:v});else{var L=$+A,N=["M"].concat(k($,v),"A",v,v,0,E>.5?1:0,1,k(L,v),"L");y?N=N.concat(k(L,y),"A",y,y,0,E>.5?1:0,0,k($,y)):N.push(g,m),$+=A,j=s("path",{d:N.join(" ")})}j.attr("fill",x.call(this,A,l,r)),c.append(j)}}}),r.register("donut",t.extend(!0,{},r.defaults.pie),function(t){r.graphers.pie.call(this,t)}),r.register("line",{delimiter:",",fill:"#c6d9fd",height:16,min:0,stroke:"#4d89f9",strokeWidth:1,width:32},function(t){var i=this.values();1==i.length&&i.push(i[0]);for(var r=e.max.apply(e,t.max==n?i:i.concat(t.max)),a=e.min.apply(e,t.min==n?i:i.concat(t.min)),h=this.prepare(t.width,t.height),l=t.strokeWidth,p=h.width(),o=h.height()-l,f=r-a,c=this.x=function(t){return t*(p/(i.length-1))},u=this.y=function(t){var i=o;return f&&(i-=(t-a)/f*o),i+l/2},d=u(e.max(a,0)),g=[0,d],m=0;m<i.length;m++)g.push(c(m),u(i[m]));g.push(p,d),t.fill&&h.append(s("polygon",{fill:t.fill,points:g.join(" ")})),l&&h.append(s("polyline",{fill:"none",points:g.slice(2,g.length-2).join(" "),stroke:t.stroke,"stroke-width":l,"stroke-linecap":"square"}))}),r.register("bar",{delimiter:",",fill:["#4D89F9"],height:16,min:0,padding:.1,width:32},function(t){for(var i=this.values(),r=e.max.apply(e,t.max==n?i:i.concat(t.max)),a=e.min.apply(e,t.min==n?i:i.concat(t.min)),h=this.prepare(t.width,t.height),l=h.width(),p=h.height(),o=r-a,f=t.padding,c=this.fill(),u=this.x=function(t){return t*l/i.length},d=this.y=function(t){return p-(o?(t-a)/o*p:1)},g=0;g<i.length;g++){var m,v=u(g+f),y=u(g+1-f)-v,w=i[g],x=d(w),k=x,$=x;o?w<0?k=d(e.min(r,0)):$=d(e.max(a,0)):m=1,m=$-k,0==m&&(m=1,r>0&&o&&k--),h.append(s("rect",{fill:c.call(this,w,g,i),x:v,y:k,width:y,height:m}))}})}(jQuery,document,Math);