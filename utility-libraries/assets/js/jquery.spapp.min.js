/*!
 * Spapp 0.0.1
 * https://github.com/amiletti/spapp
 */
!function(a){a.spapp=function(b){var c,d={};c=a.extend({defaultView:a("main#spapp > section:last-child").attr("id"),templateDir:"./tpl/",pageNotFound:!1},b),a("main#spapp > section").each(function(b,c){var e=a(this);d[e.attr("id")]={view:e.attr("id"),load:e.data("load"),onCreate:function(){},onReady:function(){}}}),this.route=function(b){a.extend(d[b.view],b)};var e=function(){var b=location.hash.slice(1),e=d[b],f=a("#"+b);return f&&e?void(f.hasClass("spapp-created")?e.onReady():(f.addClass("spapp-created"),e.load?f.load(c.templateDir+e.load,function(){e.onCreate(),e.onReady()}):(e.onCreate(),e.onReady()))):c.pageNotFound?void(window.location.hash=c.pageNotFound):void console.log(b+" not defined")};return this.run=function(){window.addEventListener("hashchange",function(){e()}),window.location.hash?e():window.location.hash=c.defaultView},this}}(jQuery);
