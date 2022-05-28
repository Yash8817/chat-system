<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="
    sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>

<body>


    <div id="wrapper">
        <h1>welcome to my website</h1>
        <div class="chat_wrapper">

            <div id="chat"></div>

            <form method="POST" id="messageFrm">
                <textarea name="message" cols="30" rows="10" class="textarea"></textarea>

            </form>
        </div>
    </div>


    <script>
        LoadChat();

        setInterval(function() {
            LoadChat();
        }, 1000);



        function LoadChat()
        {
            $.post('handlers/message.php?action=getMessages',function(response)
            {
                var scrollpos = $('#chat').scrollTop();
                var scrollpos = parseInt(scrollpos) + 520;
                var scrolheight = $('#chat').prop('scrollHeight');
                $("#chat").html(response);

                if( scrollpos < scrolheight)
                {

                }
                else
                {

                    $("#chat").scrollTop( $("#chat").prop('scrollHeight') );
                }
            });
        }




        $('.textarea').keyup(function(e) {
            if (e.which == 13) {
                $('form').submit();
            }
        });


        $('form').submit(function(){
            var message = $('.textarea').val();
            $.post('handlers/message.php?action=sendMessage&message='+message,function(response)
            {
                if(response == 1)
                {
                    LoadChat();
                    document.getElementById("messageFrm").reset();
                }
            });
            return false;
        });
    </script>
</body>

</html>