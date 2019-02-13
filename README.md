# Grooty

## What is?

Is a service that gives a welcome support menu and a FAQ. Both is served using JSON. 

## How?

### Installation

#### Retrieving the plugin

Install the jQuery and Bootstrap and then the `ent-chat.js` plugin

```html
<head>

  <link rel="stylesheet" href="/assets/vendors/bootstrap-3.3.7-dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="/assets/vendors/bootstrap-3.3.7-dist/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="http://{grooty_http_address}/assets/css/ent-chat.css">

</head>
<body>

<div class="content"></div>

<script src="/assets/vendors/jquery/jquery-3.1.0.min.js"></script>
<script src="http://{grooty_http_address}/assets/js/ent-chat.js"></script>
</body>
```
If you are using the project docker, the `grooty_http_address` is the `localhost:8082`

#### Plugin settings
The plugin needs some information to run properly and identify the client. These information are stored in a JavaScript 
object as bellow

```javascript
var entChat = {
    selfServURL: 'http://{grooty_http_address}/support',
    faqURL: 'http://{grooty_http_address}/faq-question',
    chatURL: '/chat',
    socketURL: '/message',
    clientInfo: {
        token: '376c746416e3a83bb4c93696e90d6221'
    }
};
```  
 
### Triggering

#### The welcome box
To run the plugin it's must need a `div` to inject the content and run the plugin using jQuery
```html
<div id="anjelim-box"></div>
```

```javascript
$('#anjelim-box').entChat(entChat);
```

#### The FAQ box

To render the FAQ into the page you need to have a faq container. By default it is `#ent-chat-faq`.
```html
<div id="ent-chat-faq" class="row"></div>
```

If you want to trigger something when the chat is loaded, you can use the following jQuery event watcher
```javascript
$('#ent-chat-faq').on('faq-loaded', function(){
    // Your code here
});
```

## Where is an example?

The project [Shaaman](https://github.com/anjelim/shaaman) is an complete example of the project running.