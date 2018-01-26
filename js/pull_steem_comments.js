function load_steemit_comments(author, permlink) {
    steem.api.setOptions({ url: 'https://api.steemit.com' });

    var outHTML = '<h3 id="sync-ws-comments-header">来自Steemit的评论</h3>\
                        <ol id="{0}" class="sync-ws-comments_list">\
                        <\ol>';
    jQuery("#comments").prepend(outHTML.format(permlink));    
    jQuery(document).ready(function () {
        steem.api.getContentReplies(author, permlink, contentRepliesCB);					
    });
}
function contentRepliesCB(err, result)
{
    //console.log(err, result);
    if (!err)
    { 
        //jQuery("#resultsTable").empty();
        //if(result[0].parent_permlink){}
        for (i = 0; i <= result.length - 1; i++) {
            //console.log(result[i]);
            var outObject = jQuery("#"+result[i].parent_permlink);
            var liHTML = '<li>';
            var commentAuthor = result[i].author;
            liHTML += buildCommentsDiv(commentAuthor,  new Date(result[i].last_update), result[i].body);            
										
            //jQuery("#comments").append(
                //buildCommentsDiv(commentAuthor,  new Date(result[i].last_update), result[i].body));
            if(result[i].children > 0)
            {
                liHTML += '<ul id="{0}" class="children"></ul></li>';
                var commentPermlink = result[i].permlink;
                outObject.append(liHTML.format(commentPermlink));
                steem.api.getContentReplies(commentAuthor, commentPermlink, contentRepliesCB);
            }else
            {
                outObject.append(liHTML + '</li>');    
            }         
        }
    }
    else
    { alert(err);}
}
/* 
字母  日期或时间元素  表示  示例   
G  Era 标志符  Text  AD   
y  年  Year  1996; 96   
M  年中的月份  Month  July; Jul; 07   
w  年中的周数  Number  27   
W  月份中的周数  Number  2   
D  年中的天数  Number  189   
d  月份中的天数  Number  10   
F  月份中的星期  Number  2   
E  星期中的天数  Text  Tuesday; Tue   
a  Am/pm 标记  Text  PM   
H  一天中的小时数（0-23）  Number  0   
k  一天中的小时数（1-24）  Number  24   
K  am/pm 中的小时数（0-11）  Number  0   
h  am/pm 中的小时数（1-12）  Number  12   
m  小时中的分钟数  Number  30   
s  分钟中的秒数  Number  55   
S  毫秒数  Number  978   
z  时区  General time zone  Pacific Standard Time; PST; GMT-08:00   
Z  时区  RFC 822 time zone  -0800   
 
*/  
String.prototype.repeat = function(count, seperator) {  
    var seperator = seperator || '';  
    var a = new Array(count);  
    for (var i = 0; i < count; i++){  
        a[i] = this;  
    }  
    return a.join(seperator);  
}  
  
Date.prototype.format = function(style) {  
    var o = {  
        "y{4}|y{2}" : this.getFullYear(), //year  
        "M{1,2}" : this.getMonth() + 1, //month  
        "d{1,2}" : this.getDate(),      //day  
        "H{1,2}" : this.getHours(),     //hour  
        "h{1,2}" : this.getHours()  % 12,  //hour  
        "m{1,2}" : this.getMinutes(),   //minute  
        "s{1,2}" : this.getSeconds(),   //second  
        "E" : this.getDay(),   //day in week  
        "q" : Math.floor((this.getMonth() + 3) / 3),  //quarter  
        "S{3}|S{1}"  : this.getMilliseconds() //millisecond  
    }  
    for(var k in o ){  
        style = style.replace(new RegExp("("+ k +")"), function(m){  
            return ("0".repeat(m.length) + o[k]).substr(("" + o[k]).length);  
        })  
    }  
    return style;  
};  
String.prototype.format = function(){  
    var args = arguments;  
    return this.replace(/\{(\d+)\}/g,                  
        function(m,i){  
            return args[i];  
        });  
}  
function buildCommentsDiv(title, time, commentText)
{
    var htmlString = '<div class="sync-wp-comment">\
							<div class="comment_header">\
								<cite>{0}</cite>\
								<span class="time">{1}</span>\
							</div>\
							<div class="comment_text">\
								<p>{2}</p>\
							</div>\
                        </div>';
    var timeString = time.format("yyyy年MM月dd日 HH:mm");
    return htmlString.format(title, timeString, commentText);
}