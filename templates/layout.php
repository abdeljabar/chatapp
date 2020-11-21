<!doctype html>
<html>
    <head>
        <title><?=$title?></title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    </head>
    <body>

    <nav></nav>
    <main>
        <?=$body?>
    </main>
    <footer>
        &copy; ChatApp <?=date('Y')?>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
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
    </script>
    </body>
</html>