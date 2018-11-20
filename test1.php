



<!DOCTYPE html>
<html>
<head>
    <title>
        IEEE Day, EWU CS Branch Programming Contest 2018 - Virtual Judge
    </title>

    




















  
    
    
  


<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta name="keywords" content="Online Judge, vjudge, OJ, Virtual Judge, Replay Contest, ICPC, OnlineJudge, JudgeOnline, Coding, Algorithm, ç«èµ, ç®æ³, POJ, ZOJ, UVALive, SGU, URAL, HUST, SPOJ, HDU, HYSBZ, UVA, CodeForces, Z-Trening, Aizu, LightOJ, UESTC, NBUT, FZU, CSU, SCU, ACdream, CodeChef, CF::Gym, OpenJudge, Kattis, HihoCoder, HIT, HRBUST, EIJudge, AtCoder, HackerRank, 51Nod" />
<meta name="author" content="chaoshxxu" />
<meta name="robots" content="index, follow" />

<link rel="shortcut icon" href="/static/images/logo.ico" />
<link rel="stylesheet" type="text/css" href="/static/bundle/vendor.7eaee7b5a6f4ab59f598.css" />
<link rel="stylesheet" type="text/css" href="/static/bundle/app.1c541811d7eae490961b.css" />


    <meta property="og:url" content="https://vjudge.net/contest/267314"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="IEEE Day, EWU CS Branch Programming Contest 2018 - Virtual Judge"/>
    <meta property="og:description" content="Contest [IEEE Day, EWU CS Branch Programming Contest 2018] in Virtual Judge"/>
    <meta property="og:image" content="https://vjudge.net//static/images/logo.ico"/>
</head>

<body>


<nav class="navbar navbar-dark bg-inverse">
    <button class="navbar-toggler hidden-md-up" type="button" data-toggle="collapse"
            data-target="#navbarResponsive"></button>
    <div class="collapse navbar-toggleable-sm" id="navbarResponsive">
        <a class="navbar-brand" href="/">
            <img src="/static/images/logo.ico" height="30"/>
            Home
        </a>
        <ul class="nav navbar-nav">
            <li class="nav-item" id="nav-problem">
                <a class="nav-link" href="/problem">Problem</a>
            </li>
            <li class="nav-item" id="nav-status">
                <a class="nav-link" href="/status">Status</a>
            </li>
            <li class="nav-item" id="nav-contest">
                <a class="nav-link" href="/contest">Contest</a>
            </li>
            <li class="nav-item" id="nav-user">
                <a class="nav-link" href="/user">User</a>
            </li>
            <li class="nav-item" id="nav-group">
                <a class="nav-link" href="/group">Group</a>
            </li>
            <li class="nav-item" id="nav-comment">
                <a class="nav-link" href="/comment">Forum</a>
            </li>
            <li class="nav-item" id="nav-article">
                <a class="nav-link" href="/article">Article</a>
            </li>
            
            
                
                    <li class="nav-item float-xs-right">
                        <a class="nav-link logout" href="javascript:void(0)">Logout</a>
                    </li>
                    <li class="nav-item dropdown float-xs-right">
                        <a class="nav-link dropdown-toggle" href="javascript:void(0)"
                           id="userNameDropdown" data-toggle="dropdown">amirhamza05</a>
                        <div class="dropdown-menu dropdown-menu-right user-dropdown">
                            <a class="dropdown-item"
                               href="/user/amirhamza05">Profile</a>
                            <a class="dropdown-item update-profile" href="javascript:void(0)">Update</a>
                            <a class="dropdown-item message" href="/message">Message</a>
                        </div>
                    </li>
                
                
            
        </ul>
    </div>
</nav>


<div class="container" style="margin-top: 30px;">
    
        <div class="row alert alert-info" id="contest-announcement" style="display: none;"></div>
    

    <div class="row card" id="time-info">
        <div class="row">
            <div class="col-xs-3 text-xs-left">
                <b>Begin:</b>
                <span class="timestamp">1541134800000</span>
            </div>
            <div class="col-xs-6 text-xs-center">
                <h3>
                    
                    
                    IEEE Day, EWU CS Branch Programming Contest 2018
                </h3>
            </div>
            <div class="col-xs-3 text-xs-right">
                <b>End:</b>
                <span class="timestamp">1541142000000</span>
            </div>
        </div>
        <div class="row" id="contest-time-slider-container">
            <input id="contest-time"
                   type="text"
                   data-slider-id='contest-time-slider'
                   style="display: none;"/>
        </div>
        <div class="row">
            <div class="col-xs-3 text-xs-left" id="info-elapsed">
                <b>Elapsed:</b>
                <span class="elapsed" id="span-elapsed"></span>
            </div>
            <div class="col-xs-6 text-xs-center">
                <span id="info-running"></span>
            </div>
            <div class="col-xs-3 text-xs-right" id="info-remaining">
                <b>Remaining:</b>
                <span class="remaining" id="span-remaining"></span>
            </div>
        </div>
    </div>

    
        <div class="row">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist" id="contest-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#overview" section="overview"
                       role="tab">Overview</a>
                </li>

                
               

                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#discuss" section="discuss" role="tab"
                       rel="#discuss" data-disqus-identifier="contest/267314">Discuss</a>
                </li>

                <li class="text-xs-right">
                    <div class="btn-group" role="group">
                        
                        <button type="button" class="btn btn-secondary" id="btn-favorite"><i></i>Favorite</button>
                        
                        
                    </div>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane in active" id="overview" role="tabpanel">
                    

<div id="contest_overview" class="container">

    

    <div class="row text-xs-right" id="contest-manager">
        <div class="fb-like"
             data-href="https://vjudge.net/contest/267314"
             data-layout="button_count"
             data-action="like"
             data-size="small"
             data-show-faces="true"
             data-share="true"></div>
    </div>

    <div class="row card" id="contest-description" style="display: none"></div>

</div>

                </div>
                            
                <div class="tab-pane" id="discuss" role="tabpanel">
                    
<div id="contest_discuss"></div>

                </div>
            </div>

            <div class="rank_tool">
                <span id="img_go_top" title="Go to top"></span>
            </div>
        </div>
    
    

</div>

<textarea style="display: none" name="dataJson">{"id":267314,"title":"IEEE Day, EWU CS Branch Programming Contest 2018","type":0,"openness":1,"authStatus":1,"begin":1541134800000,"end":1541142000000,"createTime":1541074542000,"started":false,"ended":false,"managerId":193457,"managerName":"amitkdas","fav":false,"enableTimeMachine":false,"sumTime":true,"penalty":0,"partialScore":false,"customizedWeight":false,"showPeers":false}</textarea>
<script type="text/javascript">moduleName = "./contest/view/view";</script>

<div class="body-footer">
    <div style="margin-bottom: 8px">
        <a href="https://t.me/joinchat/Erw7nRGwXN3iSCoKguVW3w" target="_blank">
            <img src="/static/images/social/telegram.svg"/>
        </a>
        <a href="https://www.facebook.com/virtualjudge/" target="_blank">
            <img src="/static/images/social/facebook.svg"/>
        </a>
        <a href="https://weibo.com/u/5340553087" target="_blank">
            <img src="/static/images/social/weibo.svg"/>
        </a>
        <a href="https://groups.google.com/forum/#!forum/virtual-judge" target="_blank">
            <img src="/static/images/social/google_bookmark.svg"/>
        </a>
        <a href="https://twitter.com/virtualjudge" target="_blank">
            <img src="/static/images/social/twitter.svg"/>
        </a>
        <a href="mailto:is.un@qq.com" target="_blank">
            <img src="/static/images/social/email.svg"/>
        </a>
    </div>
    All Copyright Reserved ©2018 <a href="mailto:is.un@qq.com">Xu Han</a><br/>
    Server Time: <span class="currentTimeTZ"></span>
</div>

<input name="version" type="hidden" value="1540969635845"/>

    <input id="visitor_username" name="username" type="hidden" value="amirhamza05"/>
    <input id="visitor_userId" name="userId" type="hidden" value="136134"/>
    <input id="visitor_sup" name="sup" type="hidden" value="0"/>
    <input id="newMessage" name="newMessage" type="hidden" value="false"/>


<span id="img-support" title="Feedback"></span>
<script type="text/javascript">basePath = "";</script>
<script type="text/javascript">imagesRoot = "/static/images";</script>
<script src="/static/bundle/loader.d41d8cd98f00b204e980.js?1540969635845"></script>
<script src="/static/bundle/vendor.7eaee7b5a6f4ab59f598.js"></script>
<script src="/static/bundle/app.1c541811d7eae490961b.js"></script>
<script>
  (function (i, s, o, g, r, a, m) {
    i['GoogleAnalyticsObject'] = r;
    i[r] = i[r] || function () {
      (i[r].q = i[r].q || []).push(arguments)
    }, i[r].l = 1 * new Date();
    a = s.createElement(o),
      m = s.getElementsByTagName(o)[0];
    a.async = 1;
    a.src = g;
    m.parentNode.insertBefore(a, m)
  })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
  ga('create', 'UA-13231844-2', 'auto');
  
  ga('set', 'userId', 'amirhamza05');
  
  ga('send', 'pageview');
</script>


<div id="fb-root"></div>
<script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

</body>
</html>
