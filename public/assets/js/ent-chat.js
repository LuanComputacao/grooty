(function ($) {
    $.fn.entChat = function (options) {

        var settings = $.extend({
            selfServURL: '',
            faqURL: '',
            chatURL: '',
            socketURL: '',
            clientInfo: '',
            faqContainer: '#ent-chat-faq'
        }, options);

        var container = this;

        var methods = {
            requestWelcome: function () {
                $.ajax(
                    {
                        method: "POST",
                        url: settings.selfServURL,
                        data: settings.clientInfo
                    }
                )
                    .done(function (data) {
                        if (checkSuccess(data)) {
                            methods.insertEntBox(data.view);
                        }

                        if (typeof data.app !== "undefined") {
                            if (data.app === "faq") {
                                welcome.init();
                            }
                        }
                    })
                    .fail(function () {
                        console.log("failed");
                    });
            },

            insertEntBox: function (view) {
                container.html(view);
            },
        };

        var welcome = {
            init: function () {
                welcome.watchers();
            },
            watchers: function () {
                $('.js-redirect-to-chat').on('click', function () {
                    chat.start()
                });
                $('.js-request-faq').on('click', function (event) {
                    event.preventDefault();
                    faq.init();
                });
            }
        };

        function checkSuccess(data) {
            return (typeof data.success !== 'undefined') ? (data.success === true) : false;
        }

        var faq = {
            init: function () {
                $.ajax(
                    {
                        method: "POST",
                        url: settings.faqURL,
                        data: settings.clientInfo
                    }
                )
                    .done(function (data) {
                        if (checkSuccess(data) && faq.checkFaq(data)) {
                            faq.mount(data.faq)
                        }
                    })
                    .fail(
                        function (data) {
                        }
                    );
            },
            mount: function (faq) {
                $(settings.faqContainer).html(faq);
                $(settings.faqContainer).show();
                $(settings.faqContainer).trigger('faq-loaded');
            },
            checkFaq: function (data) {
                return (typeof data.faq !== 'undefined') ? (data.faq !== '') : false;
            }
        };

        var chat = {

            templates: {},

            start: function () {
                $.ajax({
                    method: "POST",
                    url: settings.chatURL,
                    data: settings.clientInfo
                })
                    .done(function (data) {
                        if (checkSuccess(data)) {
                            chat.mount(data.view);
                        } else {
                            alert('The request has been failed');
                        }
                    })
                    .fail(function () {
                        console.log("chat fora do ar");
                    })
            },

            mount: function (view) {
                container.html(view);
                chat.watchers();
                chat.getTemplate();
            },

            watchers: function () {
                $('.js-send-button').on('click', function () {
                    chat.sendMessage()
                });

                $('#js-client-message').keyup(function (e) {
                    var keyCode = e.keyCode ? e.keyCode : e.which;
                    if (keyCode === 13) {
                        chat.sendMessage()
                    }
                });
            },

            getTemplate: function () {
                $(chat.templates.message = $('#js-message-template').find('.js-message')[0]).clone()
            },

            sendMessage: function () {
                var message = $('.js-message-editor').val();
                if (message !== "") {
                    chat.appendMessage(message);
                    chat.retrieveCommunication(message);
                }
            },

            appendMessage: function (message) {
                var newMessage = $(chat.templates.message).clone();
                newMessage.find('.js-ent-chat-message-user').html('You');
                newMessage.find('.js-ent-chat-message-text').html(message);

                $('.js-chat-history')
                    .append(newMessage)
                    .scrollTop(999999999999999);
            },

            retrieveCommunication: function () {
                $.ajax({
                    method: "POST",
                    url: settings.socketURL,
                    data: settings.clientInfo
                })
                    .done(function (data) {
                        chat.clearMessageEditor()
                    });
            },

            clearMessageEditor: function () {
                $('.js-message-editor').val("");
            }

        };


        methods.requestWelcome();


        return container;
    }
}(jQuery));


