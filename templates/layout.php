<!doctype html>
<html>
<head>
    <title><?=$title?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        #message_list_wrapper {
            display: none;
        }
    </style>
</head>
<body>

<nav></nav>
<main>
    <?=$body?>
</main>
<footer class="text-center">
    &copy; ChatApp <?=date('Y')?>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    const $container = $('#message_list');
    const $contactContainer = $('#contact_list');

    $('#message_send').submit(function (e) {
        e.preventDefault();

        let messageBody = $(this).find('#message_body');
        let messageBodyValue = messageBody.val();

        // Send a POST request
        axios({
            method: 'post',
            url: '/api/messages/send',
            data: {
                message: {
                    body: messageBodyValue,
                    from_user_id: 1,
                    to_user_id: 2,
                },
            }
        }).then(function (response) {
            if (response.data.success) {
                console.log('success');
                messageBody.clear('');
            }

        }).catch(function (error) {
            console.log('error', error.response);
        });
    });

    $('body').on('click', '.contact_choose', function (e) {

        $('#message_list_wrapper').show();
        let other = $(this).attr('data-id');

        var messageContent = '';

        axios
            .get('/api/messages', {
                params: {
                    users: {
                        current: 1,
                        other: other,
                    }
                }
            })
            .then( function (response) {
                let messages = response.data.messages;

                for (let i = 0; i < messages.length; i++) {
                    //console.log(messages[i].id);
                    messageContent += $container.attr('data-prototype')
                        .replace(/__id__/g, messages[i].id)
                        .replace(/__body__/g, messages[i].body)
                        .replace(/__from_user_id__/g, messages[i].from_user_id)
                        .replace(/__to_user_id__/g, messages[i].to_user_id)
                        .replace(/__time__/g, messages[i].created_at)
                    ;
                }

                //console.log(messageContent);

                $container.html(messageContent);

            });
    });

    $().ready(function () {
        var contactContent = '';
        axios
            .get('/api/contacts', {
            })
            .then( function (response) {
                let contacts = response.data.contacts;

                for (let i = 0; i < contacts.length; i++) {
                    console.log(contacts[i].id);
                    contactContent += $contactContainer.attr('data-prototype')
                        .replace(/__id__/g, contacts[i].id)
                        .replace(/__name__/g, contacts[i].first_name + contacts[i].last_name)
                        .replace(/__status__/g, contacts[i].status)
                    ;
                }

                console.log(contactContent);

                $contactContainer.html(contactContent);

            });
    });
</script>
</body>
</html>