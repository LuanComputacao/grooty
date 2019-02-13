/**
 * --------------------------------------------------------------------------------------------
 * Variables
 */
var routes = {
    home: '/',
    registerClient: '/manager/register-client',
    registerFaq: '/manager/register-faq',
    registerAnswer: '/manager/register-answer'
};

var entChat = {
    selfServURL: '/support',
    faqURL: '/faq-question',
    chatURL: '/chat',
    socketURL: '/message',
    clientInfo: {
        token: 'b22f9b1525cf924350fb9efaa9d4acb5'
    }
};

/**
 * --------------------------------------------------------------------------------------------
 * App
 */

function locationSearchToJson() {
    return JSON.parse('{' + window.location.search.slice(1).split('&').map(x => {
        y = x.split('=');
        return '"' + y[0] + '":' + y[1]
    }).join(',') + '}')
}

/**
 * Check if the pathname is the requested route
 *
 * @param route
 * @returns {boolean}
 */
function checkRoute(route) {
    return (window.location.pathname === route);
}

/**
 * Chec if the current route/pathname is the current one and execute the callback function if exists
 *
 * @param route
 * @param callback
 */
function onRoute(route, callback) {
    if (checkRoute(route)) {
        $(function () {
            callback();
        });
    }
}

/**
 * Check data success
 * @param data
 * @returns {boolean}
 */
function checkSuccess(data) {
    return (typeof data.success !== 'undefined') ? (data.success === true) : false;
}


onRoute(routes.home, function () {
    $('#chat').entChat(entChat);
});


onRoute(routes.registerClient, function () {
    function canSubmitClientForm(name, selfServUrl, socket, siteUrl, email, welcomePage) {
        return (name !== '' && selfServUrl !== '' && socket !== '' && siteUrl !== '' && email !== '' && welcomePage !== '');
    }

    function submitClientForm(formRegisterClient, name, selfServUrl, socket, siteUrl, email, welcomePage) {
        $.ajax({
            method: "POST",
            url: formRegisterClient.attr('action'),
            data: {
                name: name,
                selfServUrl: selfServUrl,
                socket: socket,
                siteUrl: siteUrl,
                email: email,
                welcomePage: welcomePage
            }
        })
            .done(function (data) {
                if (checkSuccess(data)) {
                    if (data['client']['created']) {
                        alert('salvo');
                    } else {
                        alert('The client exists')
                    }
                }
                location.reload();
            })
            .fail(function (data) {
                alert(data);
            });
    }

    var formRegisterClient = $('#form-register-client');

    formRegisterClient.on('submit', function (event) {
        event.preventDefault();

        var name = formRegisterClient.find('#name').val();
        var selfServUrl = formRegisterClient.find('#self-serv-url').val();
        var socket = formRegisterClient.find('#socket').val();
        var siteUrl = formRegisterClient.find('#site-url').val();
        var email = formRegisterClient.find('#email').val();
        var welcomePage = formRegisterClient.find("#welcome-page").val();

        var canSubmit = canSubmitClientForm(name, selfServUrl, socket, siteUrl, email, welcomePage);

        if (canSubmit) {
            submitClientForm(formRegisterClient, name, selfServUrl, socket, siteUrl, email, welcomePage);
        } else {
            alert('Missing some field on the form')
        }

    });

    $("#welcome-page").jqte()

});


onRoute(routes.registerFaq, function () {
    function submitFaqForm(formRegisterFaq, client, question) {
        $.ajax({
            method: "POST",
            url: formRegisterFaq.attr('action'),
            data: {
                client: client,
                question: question
            }
        })
            .done(function (data) {
                if (checkSuccess(data)) {
                    alert('created')
                } else {
                    if (data["client"] == null) {
                        alert("something went wrong");
                    } else {
                        alert("The client exists")
                    }
                }
                location.reload();
            })
            .fail(function (data) {
                alert(data)
            });
    }

    function canSubmitFaqForm(client, question) {
        var search = locationSearchToJson();
        return !isNaN(client) && question !== '' && question.length > 4 && String(search['client']) === String(client);
    }


    var formRegisterFaq = $('#form-register-faq');

    formRegisterFaq.on('submit', function (event) {
        event.preventDefault();

        var client = formRegisterFaq.find("#client").val();
        var question = formRegisterFaq.find("#question").val();

        if (canSubmitFaqForm(client, question)) {
            submitFaqForm(formRegisterFaq, client, question)
        } else {
            alert('missing some field on the form')
        }
    })
});

onRoute(routes.registerAnswer, function () {
    function submitFaqForm(formRegisterAnswer, client, question, answer) {
        $.ajax({
            method: "POST",
            url: formRegisterAnswer.attr('action'),
            data: {
                client: client,
                question: question,
                answer: answer
            }
        })
            .done(function (data) {
                if (checkSuccess(data)) {
                    alert('created')
                } else {
                    if (data["answer"] == null) {
                        alert("something went wrong");
                    } else {
                        alert("The client exists")
                    }
                }
                location.reload();
            })
            .fail(function (data) {
                alert(data)
            });
    }

    function canSubmitAnswerForm(client, question, answer) {
        var search = locationSearchToJson();
        return !isNaN(client) &&
            String(search['client']) === String(client) &&
            !isNaN(question) &&
            String(search['question']) === String(question) &&
            answer !== '' &&
            answer.length > 4
            ;
    }


    var formRegisterAnswer = $('#form-register-answer');

    formRegisterAnswer.on('submit', function (event) {
        event.preventDefault();

        var client = formRegisterAnswer.find("#client").val();
        var question = formRegisterAnswer.find("#question").val();
        var answer = formRegisterAnswer.find("#answer").val();

        if (canSubmitAnswerForm(client, question, answer)) {
            submitFaqForm(formRegisterAnswer, client, question, answer)
        } else {
            alert('missing some field on the form')
        }
    })
});
