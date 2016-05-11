//音乐
var playlist =  [{"title":"I Believe","artist":"申升勋","cover":"","mp3":"http://p2.music.126.net/FOzd7UhEhyNg1D_BLjH21Q==/1989016534661434.mp3","ogg":""},{"title":"あやとり","artist":"諫山実生","cover":"","mp3":"http://p2.music.126.net/pkjNb5c-Ux7ymQb3TdACSA==/1352399302165238.mp3","ogg":""},{"title":"secret base ~君がくれたもの~ (10 years after Ver.)","artist":"茅野愛衣,戸松遥,早見沙織","cover":"","mp3":"http://p2.music.126.net/A2gSNgN8kBWb0lOA4KDRdw==/3402988488542563.mp3","ogg":""},{"title":"Creepin' Up On You","artist":"Darren Hayes","cover":"","mp3":"http://p2.music.126.net/-y2sIhsBoxwXtaLIr_IFRg==/1036839465002624.mp3","ogg":""},{"title":"春夏秋冬","artist":"荒木毬菜","cover":"","mp3":"http://p2.music.126.net/v24kACQYu7gfXqzBDbwskg==/3300733907171352.mp3","ogg":""},{"title":"かざぐるま","artist":"一青窈","cover":"","mp3":"http://p2.music.126.net/gxZHT55Zp7JX-PY-y--vDA==/5727356069139875.mp3","ogg":""},{"title":"喜欢你","artist":"G.E.M.邓紫棋","cover":"","mp3":"http://p2.music.126.net/Aume3N8Npn_FH1R1RBlNMA==/3254554418274179.mp3","ogg":""},{"title":"我们不该这样的","artist":"张赫宣","cover":"","mp3":"http://p2.music.126.net/K2K-8bUmK714NNEACbN0vQ==/1364493938566571.mp3","ogg":""},{"title":"李白","artist":"iCsuo","cover":"","mp3":"http://p2.music.126.net/McNabLdghSuNsmhYedx2Ig==/6646547791393840.mp3","ogg":""},{"title":"Seve","artist":"Tez Cadey","cover":"","mp3":"http://p2.music.126.net/pOH2QXwQc_7IX4l2sB-iSA==/7954966629620463.mp3","ogg":""},{"title":"ラブ・ストーリーは突然に","artist":"小田和正","cover":"","mp3":"http://p2.music.126.net/ALEsy5SkeDFnrYC3OlACWg==/3345813884281772.mp3","ogg":""},{"title":"The Mass","artist":"Era","cover":"","mp3":"http://p2.music.126.net/hKyA0usmddlqqcE5GBp9nQ==/3350211931087770.mp3","ogg":""},{"title":"梦のしずく","artist":"松たか子","cover":"","mp3":"http://p2.music.126.net/XkAL1xPlso_Y9H7EbSjCFA==/2771868813632856.mp3","ogg":""},{"title":"Time Will Tell","artist":"X-Ray Dog","cover":"","mp3":"http://p2.music.126.net/hhODC_RWFrH7fovS3fvdmA==/3275445144352406.mp3","ogg":""},{"title":"夏恋","artist":"Otokaze","cover":"","mp3":"http://p2.music.126.net/RNP8C52ZXjweyr1v8oPpeQ==/5660285859840855.mp3","ogg":""},{"title":"そばにいるね 青山テルマ feat. Soulja","artist":"青山テルマ","cover":"","mp3":"http://p2.music.126.net/OMseiCBNZOSREe6tTQTR9Q==/1273234464968978.mp3","ogg":""},{"title":"Children Of The Earth(Ness's Original Re-Edit)","artist":"Ayur","cover":"","mp3":"http://p2.music.126.net/aGSa-gjUaiLLC0Tay59kxQ==/2050589185807593.mp3","ogg":""},{"title":"God is a Girl (Album Version)","artist":"Groove Coverage","cover":"","mp3":"http://p2.music.126.net/IFJXpOsM_WeGjd8CPLu6iQ==/2051688697431204.mp3","ogg":""},{"title":"风になる","artist":"つじあやの","cover":"","mp3":"http://p2.music.126.net/YJKXrEil5ZA5mm4wFauV3w==/2855431697348419.mp3","ogg":""},{"title":"Battle Without Honor or Humanity","artist":"布袋寅泰","cover":"","mp3":"http://p2.music.126.net/Oninul62X6RS1O56kOLS1g==/2048390162556605.mp3","ogg":""},{"title":"Lights - Single Version","artist":"Ellie Goulding","cover":"","mp3":"http://p2.music.126.net/g8BQ2p2em_xDuVMqZagyfw==/1238050092877558.mp3","ogg":""},{"title":"さくら ~あなたに出会えてよかった~","artist":"RSP","cover":"","mp3":"http://p2.music.126.net/TIQz0XsRd6q1bqgz5uzMBw==/3273246123485165.mp3","ogg":""},{"title":"ありがとう","artist":"大橋卓弥","cover":"","mp3":"http://p2.music.126.net/3Xu7QBdPIqdhcjF2wmbVjg==/2037395046274145.mp3","ogg":""},{"title":"ありがとう…","artist":"KOKIA","cover":"","mp3":"http://p2.music.126.net/qCbwb4Y1Li15FzIgw2immw==/3273246117982086.mp3","ogg":""},{"title":"You","artist":"Approaching Nirvana","cover":"","mp3":"http://p2.music.126.net/aVueNWYsxQzPGsEIemX-ZQ==/2075877953258328.mp3","ogg":""},{"title":"Man At Arms","artist":"Position Music","cover":"","mp3":"http://p2.music.126.net/z_VqI4J7Tn3biSfU5lozlw==/2012106278841279.mp3","ogg":""},{"title":"Through the Years & Far Away","artist":"Low","cover":"","mp3":"http://p2.music.126.net/3fMUWU7CXF0sRmQSc2jgVA==/1058829697559050.mp3","ogg":""},{"title":"潮鳴り","artist":"折戸伸治","cover":"","mp3":"http://p2.music.126.net/erP7Jg7Iui-0iVZNNf11oQ==/3437073349554928.mp3","ogg":""},{"title":"竹の歌","artist":"中島みゆき","cover":"","mp3":"http://p2.music.126.net/ugXjUnHoNIlSZhsJt_idvw==/5790028231954510.mp3","ogg":""},{"title":"孤独な巡礼","artist":"川井憲次","cover":"","mp3":"http://p2.music.126.net/qKvObj8IMXhgfMAkGGtCpA==/5691072185427713.mp3","ogg":""},{"title":"II quiet romance (杀人考察(前))","artist":"梶浦由記","cover":"","mp3":"http://p2.music.126.net/P03u4FbbYlhAeIhV1zUCMg==/3386495813954810.mp3","ogg":""},{"title":"YELL","artist":"いきものがかり","cover":"","mp3":"http://p2.music.126.net/JxTTheyJYxXzCKPUKmiwDA==/2849934139209543.mp3","ogg":""},{"title":"Blue Bird","artist":"いきものがかり","cover":"","mp3":"http://p2.music.126.net/2BHTFsArTO_TMf86dSQglQ==/1298523232407586.mp3","ogg":""},{"title":"花のように","artist":"松たか子","cover":"","mp3":"http://p2.music.126.net/KLeXiDIJq3UsP43vuvpjiQ==/2779565395027287.mp3","ogg":""},{"title":"Human Legacy","artist":"Ivan Torrent","cover":"","mp3":"http://p2.music.126.net/tJxdsbCJfp7xMRnm-1pnOg==/2917004351138778.mp3","ogg":""},{"title":"Icarus","artist":"Ivan Torrent,Julie Elven","cover":"","mp3":"http://p2.music.126.net/yDQVIoGpgSwn_iMrux5Tcw==/6011030069365802.mp3","ogg":""},{"title":"When You Say Nothing At All","artist":"Alison Krauss","cover":"","mp3":"http://p2.music.126.net/I4D23a1Lb2M_h5f3LbnwrA==/1129198441735653.mp3","ogg":""},{"title":"New Light","artist":"Mark Petrie","cover":"","mp3":"http://p2.music.126.net/w45jIRx4TOV9MyBS2LD--A==/3238061744788391.mp3","ogg":""},{"title":"Take My Hand","artist":"Omar Akram","cover":"","mp3":"http://p2.music.126.net/SijdGIiqAYtXdSNSkOOxAQ==/2052788209067069.mp3","ogg":""},{"title":"River Flows In You (Single MG Mix) - remix","artist":"Jasper Forks","cover":"","mp3":"http://p2.music.126.net/5m4TjF_5bmz8j7oIQa8oLg==/2039594069533754.mp3","ogg":""},{"title":"君と僕、届かぬ想い","artist":"佐橋俊彦","cover":"","mp3":"http://p2.music.126.net/waD0LEHF7Mms7uIYZkDdjA==/1335906627788453.mp3","ogg":""},{"title":"DOAR CU TINE","artist":"Activ","cover":"","mp3":"http://p2.music.126.net/qXAYBnxs3_7YJQCPKKZl3g==/3087428650850512.mp3","ogg":""},{"title":"Biscaine - Sunrise At Paradise Beach (Original Mix) - remix","artist":"Seven24","cover":"","mp3":"http://p2.music.126.net/6OdzUw63Lqs1pnZs6UJxbA==/1247945697565229.mp3","ogg":""},{"title":"Domino","artist":"Jessie J","cover":"","mp3":"http://p2.music.126.net/W3TKQaqWRkLRixAoSFUwJw==/2036295534652490.mp3","ogg":""},{"title":"一瞬间","artist":"丽江小倩","cover":"","mp3":"http://p2.music.126.net/CyX1LFjJFMLJbRkI-tZdjA==/1342503697548347.mp3","ogg":""},{"title":"Stupid","artist":"Tone Damli Aaberge","cover":"","mp3":"http://p2.music.126.net/P6ZvSFNBlX4AxCcNy3ji4Q==/5880188185439535.mp3","ogg":""},{"title":"君が好きだと叫びたい","artist":"BAAD","cover":"","mp3":"http://p2.music.126.net/WvETl1W2zJmqo2bjbo2xqA==/2826844395054886.mp3","ogg":""},{"title":"One more time, One more chance","artist":"山崎まさよし","cover":"","mp3":"http://p2.music.126.net/UkJp8vwSmkCG_4d1UgeOAw==/2882919492164176.mp3","ogg":""},{"title":"Oriental snow","artist":"Sentimental Scenery","cover":"","mp3":"http://p2.music.126.net/6Avyt4h6kcaEokvZfApi9w==/1021446302217511.mp3","ogg":""}];

(function($){
    // 设置
    var repeat = localStorage.repeat || 0,
        shuffle = localStorage.shuffle || 'true',
        continous = true,
        autoplay = true
    $(".song_count").text(playlist.length+" songs");
    // 加载播放列表
    for (var i = 0; i < playlist.length; i++) {
        var item = playlist[i];
        if(i<=22){
            var html="<div class=\"feed-element play_song\">"+item.artist+"<div class=\"media-body\"><strong>"+item.title+"</strong><a class=\"am-margin-right-xs pull-right\"><i class=\"am-icon-play\"></i></a></div></div>";
            $(".playlist").append(html);
        }
        //$('#playlist').append('<li class="am-text-truncate"><small class="am-padding-left-xs">' + item.title + ' - ' + item.artist + '</small></li>');
    }
    var time = new Date(),
        currentTrack = shuffle === 'true' ? time.getTime() % playlist.length : 0,
        trigger = false,
        audio, timeout, isPlaying, playCounts;

    var play = function(){
        audio.play();
        $('#play span').addClass('am-icon-pause');
        $('#music .playback').addClass('am-icon-pause');
        timeout = setInterval(updateProgress, 500);
        isPlaying = true;
    }

    var pause = function(){
        audio.pause();
        $('#music .playback').removeClass('am-icon-pause');
        $('#play span').removeClass('am-icon-pause');
        clearInterval(updateProgress);
        isPlaying = false;
    }

    // 更新进度
    var setProgress = function(value){
        var currentSec = parseInt(value%60) < 10 ? '0' + parseInt(value%60) : parseInt(value%60),
            ratio = value / audio.duration * 100;

        $('.timer').html(parseInt(value/60)+':'+currentSec);
        $('#music .ui-slider-handle').css('left', ratio + '%');
        $('#music .volume .pace').css('width', ratio + '%');
    }

    var updateProgress = function(){
        setProgress(audio.currentTime);
    }

    // 进度滑块
    // $('.progress .slider').slider({step: 0.1, slide: function(event, ui){
    //     $(this).addClass('enable');
    //     setProgress(audio.duration * ui.value / 100);
    //     clearInterval(timeout);
    // }, stop: function(event, ui){
    //     audio.currentTime = audio.duration * ui.value / 100;
    //     $(this).removeClass('enable');
    //     timeout = setInterval(updateProgress, 500);
    // }});

    // 音量滑块
    var setVolume = function(value){
        audio.volume = localStorage.volume = value;
        $('.volume .pace').css('width', value * 100 + '%');
        $('.volume .slider a').css('left', value * 100 + '%');
    }

    var volume = localStorage.volume || 0.5;
    // $('.volume .slider').slider({max: 1, min: 0, step: 0.01, value: volume, slide: function(event, ui){
    //     setVolume(ui.value);
    //     $(this).addClass('enable');
    //     $('.mute').removeClass('enable');
    // }, stop: function(){
    //     $(this).removeClass('enable');
    // }}).children('.pace').css('width', volume * 100 + '%');

    $('.mute').click(function(){
        if ($(this).hasClass('enable')){
            setVolume($(this).data('volume'));
            $(this).removeClass('enable');
        } else {
            $(this).data('volume', audio.volume).addClass('enable');
            setVolume(0);
        }
    });

    // 开关轨道
    var switchTrack = function(i){
        if (i < 0){
            track = currentTrack = playlist.length - 1;
        } else if (i >= playlist.length){
            track = currentTrack = 0;
        } else {
            track = i;
        }

        $('audio').remove();
        loadMusic(track);
        if (isPlaying == true) play();
    }

    // 拖曳
    var shufflePlay = function(){
        var time = new Date(),
            lastTrack = currentTrack;
        currentTrack = time.getTime() % playlist.length;
        if (lastTrack == currentTrack) ++currentTrack;
        switchTrack(currentTrack);
    }

    // Fire when track ended
    var ended = function(){
        pause();
        audio.currentTime = 0;
        playCounts++;
        if (continous == true) isPlaying = true;
        if (repeat == 1){
            play();
        } else {
            if (shuffle === 'true'){
                shufflePlay();
            } else {
                if (repeat == 2){
                    switchTrack(++currentTrack);
                } else {
                    if (currentTrack < playlist.length) switchTrack(++currentTrack);
                }
            }
        }
    }

    var beforeLoad = function(){
        var endVal = this.seekable && this.seekable.length ? this.seekable.end(0) : 0;
        $('.progress .loaded').css('width', (100 / (this.duration || 1) * endVal) +'%');
    }

    // Fire when track loaded completely
    var afterLoad = function(){
        if (autoplay == true) play();
    }

    // Load track
    var loadMusic = function(i){
        var item = playlist[i],
        newaudio = $('<audio>').html('<source src="' + item.mp3 + '"><source src="' + item.ogg + '">').appendTo('#music-list');
        $('.cover').html('<img src="'+item.cover+'" alt="'+item.album+'">');
        $('.tag').html('<b class="am-margin-right-xs timer">0:00</b><strong class="am-margin-right-xs">' + item.title + '</strong><span class="artist">' + item.artist + '</span>');
        $('.play_song i').removeClass('am-icon-pause').eq(i).addClass('am-icon-pause');
        audio = newaudio[0];
        audio.volume = $('.mute').hasClass('enable') ? 0 : volume;
        audio.addEventListener('progress', beforeLoad, false);
        audio.addEventListener('durationchange', beforeLoad, false);
        audio.addEventListener('canplay', afterLoad, false);
        audio.addEventListener('ended', ended, false);
    }

    loadMusic(currentTrack);
    $('#play span').on('click', function(){
        if ($(this).hasClass('am-icon-pause')){
            pause();
        } else {
            play();
        }
    });
    $('.playback').on('click',function() {
        if ($(this).hasClass('am-icon-pause')) {
            pause();
        } else {
            play();
        }
    });
    $('.rewind').on('click', function(){
        if (shuffle === 'true'){
            shufflePlay();
        } else {
            switchTrack(--currentTrack);
        }
    });
    $('.fastforward').on('click', function(){
        if (shuffle === 'true'){
            shufflePlay();
        } else {
            switchTrack(++currentTrack);
        }
    });
    $('.feed-element a').each(function(i){
        var _i = i;
        $(this).on('click', function(){
            switchTrack(_i);
        });
    });

    if (shuffle === 'true') $('.shuffle').addClass('enable');
    if (repeat == 1){
        $('.repeat').addClass('once');
    } else if (repeat == 2){
        $('.repeat').addClass('all');
    }

    $('.repeat').on('click', function(){
        if ($(this).hasClass('once')){
            repeat = localStorage.repeat = 2;
            $(this).removeClass('once').addClass('all');
        } else if ($(this).hasClass('all')){
            repeat = localStorage.repeat = 0;
            $(this).removeClass('all');
        } else {
            repeat = localStorage.repeat = 1;
            $(this).addClass('once');
        }
    });

    $('.shuffle').on('click', function(){
        if ($(this).hasClass('enable')){
            shuffle = localStorage.shuffle = 'false';
            $(this).removeClass('enable');
        } else {
            shuffle = localStorage.shuffle = 'true';
            $(this).addClass('enable');
        }
    });
})(jQuery);