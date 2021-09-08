<template>

</template>

<script>
    import Echo from "laravel-echo";
    import {EventBus} from '../app.js';
    import axios from 'axios';
    export default {
        name: 'messages-component',
        data: () => ({}),
        props: [
            'auth_user_id',
        ],
        mounted() {
            this.echo();

        },
        methods: {
            echo() {
                
                this.$echo
                    .private('messages.' + window.auth_user_id)
                    .listen('MessageSent', (e) => {
                        
                       this.created();
                    
                        this.sentMessageNotification(e.user.name  + ' sent you message.');
                       $('.message-notification-icon').addClass('text-success');
                       if($('#private-messages-'+e.message.conversation_id).length)
                            this.added(e.message );
                    });
                this.$echo
                    .private('activity.' + window.auth_user_id)
                    .listen('ActivityCreated', (e) => {
                        var msg;
                        switch(e.type){
                            case 'like':
                                msg = e.from_user_name  + ' liked your adventure.';
                            break;

                            case 'comment':
                                msg = e.from_user_name  +' commented your adventure.';
                            break;

                            case 'visited':
                                msg = e.from_user_name + ' set "I was here" on your adventure';
                            break;

                            break;
                        }
                        this.sentMessageNotification(msg)

                    });

            },
            sentMessageNotification(msg){
                if(!msg)
                msg = user + ' sent you message';
                if (!("Notification" in window)) {
            //
                }
            //
               
                else if (Notification.permission === "granted") {
                    
                    var notification = new Notification(msg);
                }
            //
               
                else if (Notification.permission !== 'denied') {
                    Notification.requestPermission(function (permission) {
                        
                        if (permission === "granted") {
                            var notification = new Notification(msg);
                        }
                    });
                }
            },

            created() {

                axios.get('/getLastMessagesView').then(({data}) => {
                    $('#last-messages').html(data);
                });
                if(  $('#all-messages').length)
                axios.get('/getAllMessagesView').then(({data}) => {
                    $('#all-messages').html(data);
                });
            },
            added(message){
                axios.post('/getSingleMessageView?message_id=' + message.id).then(({data}) => {
                    var body = (message.body);

                    $('#private-messages-'+message.conversation_id).append(data);
                    let el = $('#scroll-message');
                    var matches = body.match(/\bhttps?:\/\/\S+/gi);
                    if(matches && matches.length > 0)
                    axios.get('https://api.linkpreview.net/?key=5da644cd8a58b9dde4d7713ae64986ab6f5c9f9cf94d3&q='+matches[0]).then(({data}) => {
                        var linkData = '<h5>'+ data.title + '</h5><a target="_blank" href="' + data.url+ '"><img style="width:300px;" src="'+ data.image +'"></a><br>';

                        $('#private-messages-'+message.conversation_id).append(linkData);
                        el.scrollTop(el[0].scrollHeight);
                    });


                    el.scrollTop(el[0].scrollHeight);

                });

            }

        }
    }
</script>