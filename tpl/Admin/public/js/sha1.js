/*
 * [js-sha1]{@link https://github.com/emn178/js-sha1}
 *
 * @version 0.4.1
 * @author Chen, Yi-Cyuan [emn178@gmail.com]
 * @copyright Chen, Yi-Cyuan 2014-2016
 * @license MIT
 */
!function(){"use strict";function t(t){t?(f[0]=f[16]=f[1]=f[2]=f[3]=f[4]=f[5]=f[6]=f[7]=f[8]=f[9]=f[10]=f[11]=f[12]=f[13]=f[14]=f[15]=0,this.blocks=f):this.blocks=[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],this.h0=1732584193,this.h1=4023233417,this.h2=2562383102,this.h3=271733878,this.h4=3285377520,this.block=this.start=this.bytes=0,this.finalized=this.hashed=!1,this.first=!0}var h="object"==typeof window?window:{},i=!h.JS_SHA1_NO_NODE_JS&&"object"==typeof process&&process.versions&&process.versions.node;i&&(h=global);var s=!h.JS_SHA1_NO_COMMON_JS&&"object"==typeof module&&module.exports,e="function"==typeof define&&define.amd,r="0123456789abcdef".split(""),o=[-2147483648,8388608,32768,128],n=[24,16,8,0],a=["hex","array","digest","arrayBuffer"],f=[],u=function(h){return function(i){return new t(!0).update(i)[h]()}},c=function(){var h=u("hex");i&&(h=p(h)),h.create=function(){return new t},h.update=function(t){return h.create().update(t)};for(var s=0;s<a.length;++s){var e=a[s];h[e]=u(e)}return h},p=function(t){var h=require("crypto"),i=require("buffer").Buffer,s=function(s){if("string"==typeof s)return h.createHash("sha1").update(s,"utf8").digest("hex");if(s.constructor===ArrayBuffer)s=new Uint8Array(s);else if(void 0===s.length)return t(s);return h.createHash("sha1").update(new i(s)).digest("hex")};return s};t.prototype.update=function(t){if(!this.finalized){var i="string"!=typeof t;i&&t.constructor===h.ArrayBuffer&&(t=new Uint8Array(t));for(var s,e,r=0,o=t.length||0,a=this.blocks;o>r;){if(this.hashed&&(this.hashed=!1,a[0]=this.block,a[16]=a[1]=a[2]=a[3]=a[4]=a[5]=a[6]=a[7]=a[8]=a[9]=a[10]=a[11]=a[12]=a[13]=a[14]=a[15]=0),i)for(e=this.start;o>r&&64>e;++r)a[e>>2]|=t[r]<<n[3&e++];else for(e=this.start;o>r&&64>e;++r)s=t.charCodeAt(r),128>s?a[e>>2]|=s<<n[3&e++]:2048>s?(a[e>>2]|=(192|s>>6)<<n[3&e++],a[e>>2]|=(128|63&s)<<n[3&e++]):55296>s||s>=57344?(a[e>>2]|=(224|s>>12)<<n[3&e++],a[e>>2]|=(128|s>>6&63)<<n[3&e++],a[e>>2]|=(128|63&s)<<n[3&e++]):(s=65536+((1023&s)<<10|1023&t.charCodeAt(++r)),a[e>>2]|=(240|s>>18)<<n[3&e++],a[e>>2]|=(128|s>>12&63)<<n[3&e++],a[e>>2]|=(128|s>>6&63)<<n[3&e++],a[e>>2]|=(128|63&s)<<n[3&e++]);this.lastByteIndex=e,this.bytes+=e-this.start,e>=64?(this.block=a[16],this.start=e-64,this.hash(),this.hashed=!0):this.start=e}return this}},t.prototype.finalize=function(){if(!this.finalized){this.finalized=!0;var t=this.blocks,h=this.lastByteIndex;t[16]=this.block,t[h>>2]|=o[3&h],this.block=t[16],h>=56&&(this.hashed||this.hash(),t[0]=this.block,t[16]=t[1]=t[2]=t[3]=t[4]=t[5]=t[6]=t[7]=t[8]=t[9]=t[10]=t[11]=t[12]=t[13]=t[14]=t[15]=0),t[15]=this.bytes<<3,this.hash()}},t.prototype.hash=function(){var t,h,i,s=this.h0,e=this.h1,r=this.h2,o=this.h3,n=this.h4,a=this.blocks;for(h=16;80>h;++h)i=a[h-3]^a[h-8]^a[h-14]^a[h-16],a[h]=i<<1|i>>>31;for(h=0;20>h;h+=5)t=e&r|~e&o,i=s<<5|s>>>27,n=i+t+n+1518500249+a[h]<<0,e=e<<30|e>>>2,t=s&e|~s&r,i=n<<5|n>>>27,o=i+t+o+1518500249+a[h+1]<<0,s=s<<30|s>>>2,t=n&s|~n&e,i=o<<5|o>>>27,r=i+t+r+1518500249+a[h+2]<<0,n=n<<30|n>>>2,t=o&n|~o&s,i=r<<5|r>>>27,e=i+t+e+1518500249+a[h+3]<<0,o=o<<30|o>>>2,t=r&o|~r&n,i=e<<5|e>>>27,s=i+t+s+1518500249+a[h+4]<<0,r=r<<30|r>>>2;for(;40>h;h+=5)t=e^r^o,i=s<<5|s>>>27,n=i+t+n+1859775393+a[h]<<0,e=e<<30|e>>>2,t=s^e^r,i=n<<5|n>>>27,o=i+t+o+1859775393+a[h+1]<<0,s=s<<30|s>>>2,t=n^s^e,i=o<<5|o>>>27,r=i+t+r+1859775393+a[h+2]<<0,n=n<<30|n>>>2,t=o^n^s,i=r<<5|r>>>27,e=i+t+e+1859775393+a[h+3]<<0,o=o<<30|o>>>2,t=r^o^n,i=e<<5|e>>>27,s=i+t+s+1859775393+a[h+4]<<0,r=r<<30|r>>>2;for(;60>h;h+=5)t=e&r|e&o|r&o,i=s<<5|s>>>27,n=i+t+n-1894007588+a[h]<<0,e=e<<30|e>>>2,t=s&e|s&r|e&r,i=n<<5|n>>>27,o=i+t+o-1894007588+a[h+1]<<0,s=s<<30|s>>>2,t=n&s|n&e|s&e,i=o<<5|o>>>27,r=i+t+r-1894007588+a[h+2]<<0,n=n<<30|n>>>2,t=o&n|o&s|n&s,i=r<<5|r>>>27,e=i+t+e-1894007588+a[h+3]<<0,o=o<<30|o>>>2,t=r&o|r&n|o&n,i=e<<5|e>>>27,s=i+t+s-1894007588+a[h+4]<<0,r=r<<30|r>>>2;for(;80>h;h+=5)t=e^r^o,i=s<<5|s>>>27,n=i+t+n-899497514+a[h]<<0,e=e<<30|e>>>2,t=s^e^r,i=n<<5|n>>>27,o=i+t+o-899497514+a[h+1]<<0,s=s<<30|s>>>2,t=n^s^e,i=o<<5|o>>>27,r=i+t+r-899497514+a[h+2]<<0,n=n<<30|n>>>2,t=o^n^s,i=r<<5|r>>>27,e=i+t+e-899497514+a[h+3]<<0,o=o<<30|o>>>2,t=r^o^n,i=e<<5|e>>>27,s=i+t+s-899497514+a[h+4]<<0,r=r<<30|r>>>2;this.h0=this.h0+s<<0,this.h1=this.h1+e<<0,this.h2=this.h2+r<<0,this.h3=this.h3+o<<0,this.h4=this.h4+n<<0},t.prototype.hex=function(){this.finalize();var t=this.h0,h=this.h1,i=this.h2,s=this.h3,e=this.h4;return r[t>>28&15]+r[t>>24&15]+r[t>>20&15]+r[t>>16&15]+r[t>>12&15]+r[t>>8&15]+r[t>>4&15]+r[15&t]+r[h>>28&15]+r[h>>24&15]+r[h>>20&15]+r[h>>16&15]+r[h>>12&15]+r[h>>8&15]+r[h>>4&15]+r[15&h]+r[i>>28&15]+r[i>>24&15]+r[i>>20&15]+r[i>>16&15]+r[i>>12&15]+r[i>>8&15]+r[i>>4&15]+r[15&i]+r[s>>28&15]+r[s>>24&15]+r[s>>20&15]+r[s>>16&15]+r[s>>12&15]+r[s>>8&15]+r[s>>4&15]+r[15&s]+r[e>>28&15]+r[e>>24&15]+r[e>>20&15]+r[e>>16&15]+r[e>>12&15]+r[e>>8&15]+r[e>>4&15]+r[15&e]},t.prototype.toString=t.prototype.hex,t.prototype.digest=function(){this.finalize();var t=this.h0,h=this.h1,i=this.h2,s=this.h3,e=this.h4;return[t>>24&255,t>>16&255,t>>8&255,255&t,h>>24&255,h>>16&255,h>>8&255,255&h,i>>24&255,i>>16&255,i>>8&255,255&i,s>>24&255,s>>16&255,s>>8&255,255&s,e>>24&255,e>>16&255,e>>8&255,255&e]},t.prototype.array=t.prototype.digest,t.prototype.arrayBuffer=function(){this.finalize();var t=new ArrayBuffer(20),h=new DataView(t);return h.setUint32(0,this.h0),h.setUint32(4,this.h1),h.setUint32(8,this.h2),h.setUint32(12,this.h3),h.setUint32(16,this.h4),t};var d=c();s?module.exports=d:(h.sha1=d,e&&define(function(){return d}))}();

/*******************************************************************************
* jQuery hash算法插件
*
* @author:Allen
* @date:2016/10/22
******************************************************************************/
(function() {
// 检查是否引入了jquery库
if (typeof jQuery == 'undefined')
return false;
// 检查是否支持File等对象
if (!window.File || !window.FileReader || !window.FileList || !window.Blob || !File.prototype.slice)
return false;
// 处理不同浏览器中的File、Blob对象分割方法slice
if ((typeof File == 'undefined'))
return false;
if (!File.prototype.slice) {
if (File.prototype.webkitSlice)
File.prototype.slice = File.prototype.webkitSlice;
else if (File.prototype.mozSlice)
File.prototype.slice = File.prototype.mozSlice;
}
return true;
})() && (function($) {
/**
* 工具方法集
*/
var util = g = {
rotl : function(a, b) {
return a << b | a >>> 32 - b;
},
rotr : function(a, b) {
return a << 32 - b | a >>> b;
},
endian : function(a) {
if (a.constructor == Number)
return g.rotl(a, 8) & 16711935 | g.rotl(a, 24) & 4278255360;
for (var b = 0; b < a.length; b++)
a[b] = g.endian(a[b]);
return a;
},
randomBytes : function(a) {
for (var b = []; a > 0; a--)
b.push(Math.floor(Math.random() * 256));
return b;
},
bytesToWords : function(a) {
for (var b = [], c = 0, d = 0; c < a.length; c++, d += 8)
b[d >>> 5] |= a[c] << 24 - d % 32;
return b;
},
wordsToBytes : function(a) {
for (var b = [], c = 0; c < a.length * 32; c += 8)
b.push(a[c >>> 5] >>> 24 - c % 32 & 255);
return b;
},
bytesToHex : function(a) {
for (var b = [], c = 0; c < a.length; c++)
b.push((a[c] >>> 4).toString(16)), b.push((a[c] & 15).toString(16));
return b.join("");
},
hexToBytes : function(a) {
for (var b = [], c = 0; c < a.length; c += 2)
b.push(parseInt(a.substr(c, 2), 16));
return b;
},
bytesToBase64 : function(a) {
if (typeof btoa == "function")
return btoa(f.bytesToString(a));
for (var b = [], c = 0; c < a.length; c += 3)
for (var d = a[c] << 16 | a[c + 1] << 8 | a[c + 2], e = 0; e < 4; e++)
c * 8 + e * 6 <= a.length * 8 ? b.push("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/".charAt(d >>> 6 * (3 - e) & 63)) : b.push("=");
return b.join("");
},
base64ToBytes : function(a) {
if (typeof atob == "function")
return f.stringToBytes(atob(a));
for (var a = a.replace(/[^A-Z0-9+/]/ig, ""), b = [], c = 0, d = 0; c < a.length; d = ++c % 4)
d != 0 && b.push(("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/".indexOf(a.charAt(c - 1)) & Math.pow(2, -2 * d + 8) - 1) << d * 2 | "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/".indexOf(a.charAt(c)) >>> 6 - d * 2);
return b;
}
};
/**
* sha1算法处理
*
* @param (Array){block}分块数组
* @param (Array){hash}当前计算出的hash数组
*/
var sha1 = function(block, hash) {
var words = [];
var count_parts = 16;
var h0 = hash[0], h1 = hash[1], h2 = hash[2], h3 = hash[3], h4 = hash[4];
for (var i = 0; i < block.length; i += count_parts) {
var th0 = h0, th1 = h1, th2 = h2, th3 = h3, th4 = h4;
for (var j = 0; j < 80; j++) {
if (j < count_parts)
words[j] = block[i + j] | 0;
else {
var n = words[j - 3] ^ words[j - 8] ^ words[j - 14] ^ words[j - count_parts];
words[j] = (n << 1) | (n >>> 31);
}
var f, k;
if (j < 20) {
f = (h1 & h2 | ~h1 & h3);
k = 1518500249;
} else if (j < 40) {
f = (h1 ^ h2 ^ h3);
k = 1859775393;
} else if (j < 60) {
f = (h1 & h2 | h1 & h3 | h2 & h3);
k = -1894007588;
} else {
f = (h1 ^ h2 ^ h3);
k = -899497514;
}
var t = ((h0 << 5) | (h0 >>> 27)) + h4 + (words[j] >>> 0) + f + k;
h4 = h3;
h3 = h2;
h2 = (h1 << 30) | (h1 >>> 2);
h1 = h0;
h0 = t;
}
h0 = (h0 + th0) | 0;
h1 = (h1 + th1) | 0;
h2 = (h2 + th2) | 0;
h3 = (h3 + th3) | 0;
h4 = (h4 + th4) | 0;
}
return [ h0, h1, h2, h3, h4 ];
}
/**
* 通过字符数组对应的Unicode数组得到相应的hash值
*
* @param (Uint8Array){charCodeArr}字符数组对应的Unicode数组，例如：[97,98,99]
* @param (Function){method}计算hash所用的加密方法，如sha1等
* @param (Number)buffer分块处理的块大小
* @return (Array){hash}hash数组
*/
var getHash = function(charCodeArr, method, buffer) {
(buffer && buffer > 0) || (buffer = 1024 * 16 * 64);// 处理默认的buffer
var hash = [ 1732584193, -271733879, -1732584194, 271733878, -1009589776 ];
var len = charCodeArr.length;
var start = 0;
var end = buffer - 1;
var block;
while (start + 1 <= len) {
end = Math.min(end, len - 1);
block = util.bytesToWords(charCodeArr.subarray(start, end + 1));
if (end === len - 1) {
var bTotal, bLeft, bTotalH, bTotalL;
bTotal = len * 8;
bLeft = (end - start + 1) * 8;
bTotalH = Math.floor(bTotal / 0x100000000);
bTotalL = bTotal & 0xFFFFFFFF;
// Padding
block[bLeft >>> 5] |= 0x80 << (24 - bLeft % 32);
block[((bLeft + 64 >>> 9) << 4) + 14] = bTotalH;
block[((bLeft + 64 >>> 9) << 4) + 15] = bTotalL;
}
hash = method(block, hash);
start += buffer;
end += buffer;
}
return hash;
}
/**
* 通过字符数组对应的Unicode数组得到sha1值
*
* @param (Uint8Array){charCodeArr}字符数组对应的Unicode数组，例如：[97,98,99]
* @param (Number){buffer}分块处理的块大小
* @return (String){sha1}sha1值
*/
var getSha1 = function(charCodeArr, buffer) {
var hash = getHash(charCodeArr, sha1, buffer);
return util.bytesToHex(hash);
}
/**
* 获取字符串的sha1
*
* @param (String){str}字符串
* @return (String){sha1}字符串对应的sha1值
*/
var getSha1FromStr = function(str) {
var len = str.length;
var b = [ len ];
for (var i = 0; i < len; i++) {
b[i] = str.charCodeAt(i);
}
return getSha1(new Uint8Array(b), 10240);
}
/**
* 获取文件的sha1
*
* @param (File){file}文件对象
* @return (String){sha1}sha1值
*/
var getSha1FromFile = function(file, callback) {
var reader = new FileReader();
reader.readAsArrayBuffer(file);
reader.onload = function(e) {
var u8Arr = new Uint8Array(e.target.result);
var sha1 = jQuery.hash.getSha1(u8Arr, 10240);
file.sha1 = sha1;
callback(e, sha1);
}
}
$.hash = {
util : util,
getSha1 : getSha1,
getSha1FromStr : getSha1FromStr,
getSha1FromFile : getSha1FromFile
};
})(jQuery);