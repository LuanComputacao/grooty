# Grooty

## First of all, an example to run

The project [Shaaman](https://github.com/anjelim/shaaman) is an complete example of the project running.

## What is?

Is a service that gives a welcome support menu and a FAQ. Both is served using JSON. 

## How?

### Registering a client

#### Client registration
1. In the Home page click in the _Register and Manage Client_ button
1. Insert the content in the input fields
1. Click send to save

#### Question registration
1. In the __Client Register page__ page click in the _id of the client_ on the _Clients list_
1. This will open the __FAQ Register page__ for the current user
1. Insert the content in the input fields
1. Click send to save


#### Answers registration
1. In the __FAQ Register page__ click in the _id of the question_ on the _Questions List_
1. This will open the __FAQ Answers Register page__ for the question of a client
1. Insert the content in the input fields
1. Click send to save


### Installation in the client side

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

## Diagrams

### How it works over the network

![Network Diagram](/docs/network_diagram.png)

### Use Cases
#### Thing that the a user of a Client Site can do
![UC Client](/docs/UC_cliente.png)

#### Thing Client Site can do over the network and what the Grooty Service Does
![UC Client Site and Grooty Service](/docs/UC_grooty_service__client_site.png)

#### Thing that a manager can do in the Grooty Service
![UC Client Manager](/docs/UC_client_manager.png)

### MER
![Entity-relationship Diagram](/docs/MER.png)

### DER
![Entity-relationship Diagram](/docs/DER.png)
