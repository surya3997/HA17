(function($) {

    var FakePoller = function(options, callback, levels, cnts) {
        var defaults = {
            frequency: 60,
            limit: 12
        };
        this.callback = callback;
        this.config = $.extend(defaults, options);

        var place_names = ["India", "China", "Russia", "Malaysia", "Russia Komi-republic", "South Africa", "Argentina", "Brazil", "California", "Alabama", "UK", "Australia"];

        this.list = [];
        this.cnts = cnts;
        for (var i = 0; i < levels.length; i++) {
            this.list.push(place_names[parseInt(levels[i]) - 1]);
        }
    }
    FakePoller.prototype.getData = function() {

        var cnts = [];
        var lvls = [];
        var results = [];
        for (var i = 0, len = this.list.length; i < len; i++) {
            results.push({
                name: this.list[i],
                count: this.cnts[i]
            });
        }

        return results;
    };

    change_flag = 0;
    FakePoller.prototype.processData = function() {
        if (change_flag == 0 || this.list.length < this.config.limit) {
            change_flag = 1;
            var processed = this.sortData(this.getData()).slice(0, this.config.limit);
            return processed;
        } else {
            change_flag = 0;
            var processed = this.sortData(this.getData()).slice(this.config.limit, this.list.length);
            return processed;
        }
    };

    FakePoller.prototype.sortData = function(data) {
        return data.sort(function(a, b) {
            return b.count - a.count;
        });
    };
    FakePoller.prototype.start = function() {
        var _this = this;
        this.interval = setInterval((function() {
            _this.callback(_this.processData());
        }), this.config.frequency * 1000);
        this.callback(this.processData());
        return this;
    };
    FakePoller.prototype.stop = function() {
        clearInterval(this.interval);
        return this;
    };
    window.FakePoller = FakePoller;

    var Leaderboard = function(elemId, options, levels, cnts) {
        var _this = this;
        var defaults = {
            limit: 6,
            frequency: 15
        };
        this.currentItem = 0;
        this.currentCount = 0;
        this.config = $.extend(defaults, options);

        this.$elem = $(elemId);
        if (!this.$elem.length)
            this.$elem = $('<div>').appendTo($('body'));

        this.list = [];
        this.$leaderboard_content = $('<ul>');
        this.$elem.append(this.$leaderboard_content);

        this.poller = new FakePoller({ frequency: this.config.frequency, limit: this.config.limit }, function(data) {
            if (data) {
                if (_this.currentCount != data.length) {
                    _this.buildElements(_this.$leaderboard_content, data.length);
                }
                _this.currentCount = data.length;
                _this.data = data;
                if (_this.list.length != 0)
                    _this.list[0].$item.addClass('animate');
            }
        }, levels, cnts);

        this.poller.start();
    };

    Leaderboard.prototype.buildElements = function($ul, elemSize) {
        var _this = this;
        $ul.empty();
        this.list = [];
        this.cnts = [];

        for (var i = 0; i < elemSize; i++) {
            var item = $('<li>')
                .on("animationend webkitAnimationEnd oAnimationEnd", eventAnimationEnd.bind(this))
                .appendTo($ul);
            this.list.push({
                $item: item,
                $name: $('<span class="name">Loading...</span>').appendTo(item),
                $count: $('<span class="count">Loading...</span>').appendTo(item)
            });
        }

        function eventAnimationEnd(evt) {
            this.list[this.currentItem].$name.text(_this.data[this.currentItem].name);
            this.list[this.currentItem].$count.text(_this.data[this.currentItem].count);
            this.list[this.currentItem].$item.removeClass('animate');
            this.currentItem = this.currentItem >= this.currentCount - 1 ? 0 : this.currentItem + 1;
            if (this.currentItem != 0) {
                this.list[this.currentItem].$item.addClass('animate');
            }
        }
    };

    Function.prototype.bind = function() {
        var fn = this,
            args = Array.prototype.slice.call(arguments),
            object = args.shift();
        return function() {
            return fn.apply(object, args.concat(Array.prototype.slice.call(arguments)));
        };
    };

    window.Leaderboard = Leaderboard;
    //Helper
    function rnd(min, max) {
        min = min || 100;
        if (!max) {
            max = min;
            min = 1;
        }
        return Math.floor(Math.random() * (max - min + 1) + min);
    }

    function numberFormat(num) {
        return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

})(jQuery);

$(document).ready(function($) {
    $.post('ajax/getLeaderboardCount.php', {}, function(resp) {
        leader_data = JSON.parse(resp);
        var myLeaderboard = new Leaderboard(".leaderboard_content", { limit: 6, frequency: 12 }, leader_data.level_id, leader_data.count);
    });
});