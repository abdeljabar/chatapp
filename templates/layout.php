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

<main><?=$body?></main>
<footer class="text-center">&copy; ChatApp <?=date('Y')?></footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    const $messageContainer = $('#message_list');
    const $contactContainer = $('#contact_list');
    const currentUser = parseInt("<?=$currentUser?>");
    let chosenUser = 0;

    $('#message_send').submit(function (e) {
        e.preventDefault();

        console.log('chosenUser', chosenUser);

        let messageBody = $(this).find('#message_body');
        let messageBodyValue = messageBody.val();

        // Send a POST request
        axios({
            method: 'post',
            url: '/api/messages/send',
            data: {
                message: {
                    body: messageBodyValue,
                    from_user_id: currentUser,
                    to_user_id: chosenUser,
                },
            }
        }).then(function (response) {
            console.log('success');

            let messageNew = $messageContainer.attr('data-prototype')
                .replace(/__id__/g, response.data.message.id)
                .replace(/__body__/g, response.data.message.body)
                .replace(/__from_user_id__/g, response.data.message.from_user_id)
                .replace(/__to_user_id__/g, response.data.message.to_user_id)
                .replace(/__time__/g, response.data.message.created_at)
            ;

            console.log('messageNew', messageNew);

            $messageContainer.append( messageNew );

            messageBody.val('');

        }).catch(function (error) {
            console.log('error', error.response);
        });
    });

    $('body').on('click', '.contact_choose', function (e) {

        $('#message_list_wrapper').show();
        chosenUser = $(this).attr('data-id');
        var messageContent = '';

        axios
            .get('/api/messages', {
                params: {
                    users: {
                        current: currentUser,
                        other: chosenUser,
                    }
                }
            })
            .then( function (response) {
                let messages = response.data.messages;

                for (let i = 0; i < messages.length; i++) {
                    messageContent += $messageContainer.attr('data-prototype')
                        .replace(/__id__/g, messages[i].id)
                        .replace(/__body__/g, messages[i].body)
                        .replace(/__from_user_id__/g, messages[i].from_user_id)
                        .replace(/__to_user_id__/g, messages[i].to_user_id)
                        .replace(/__time__/g, messages[i].created_at)
                    ;
                }

                $messageContainer.html(messageContent);

            });
    });

    $().ready(function () {
        var contactContent = '';
        axios
            .get('/api/contacts', {
                params : {
                    currentUser: currentUser
                }
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

                $contactContainer.html(contactContent);

            });
    });
</script>
</body>
</html>