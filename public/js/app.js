
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('31c79ef0bedc8601377b', {
      cluster: 'mt1',
      forceTLS: true
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
      console.log(data.message);
     //app.messages.push(data.message);
      
    });

    // Vue application
    const app = new Vue({
      el: '#app',
      data: {
        messages: 'ola',
      },
    });
 