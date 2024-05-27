<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Google Review</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
</head>
<body>
<div class="whole">
    <div class="container">
        <form id="feedbackForm">
            @csrf
            <h1>Rate your experience</h1>
            <h3>We highly value your feedback! Kindly take a moment to rate your experience and provide us with your
                valuable feedback</h3>
            <div class="rate">
                <input type="radio" id="star5" name="rate" value="5" required/>
                <label for="star5" title="text">5 stars</label>
                <input type="radio" id="star4" name="rate" value="4" required/>
                <label for="star4" title="text">4 stars</label>
                <input type="radio" id="star3" name="rate" value="3" required/>
                <label for="star3" title="text">3 stars</label>
                <input type="radio" id="star2" name="rate" value="2" required/>
                <label for="star2" title="text">2 stars</label>
                <input type="radio" id="star1" name="rate" value="1" required/>
                <label for="star1" title="text">1 star</label>
            </div>
            <div class="inputDiv">
                <input class="controlInput" id="name" type="text" name="name" placeholder="Full Name" required/>
            </div>
            <div class="inputDiv">
                <input class="controlInput" id="email" type="email" name="email" placeholder="Email" required/>
            </div>
            <textarea class="controlInput" id="experience" name="experience" rows="5" required>Tell us about your experience</textarea>
            <button type="submit" onclick="sendMail()">Send</button>
        </form>
    </div>
</div>
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">X</span>
        <p>Thank you for your feedback!</p>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        let modal = $('#myModal');
        let form = $('#feedbackForm');
        let span = $('.close');

        form.on('submit', function (event) {
            event.preventDefault();

            if (form[0].checkValidity()) {
                $.ajax({
                    url: '{{ route("feedback.store") }}',
                    type: 'POST',
                    data: form.serialize(),
                    success: function (response) {
                        modal.show();
                    },
                    error: function (xhr) {
                        alert('Something went wrong. Please try again.');
                    }
                });
            }
        });

        span.on('click', function () {
            modal.hide();
            resetForm();
        });

        $(window).on('click', function (event) {
            if (event.target === modal[0]) {
                modal.hide();
                resetForm();
            }
        });

        function resetForm() {
            form[0].reset();
        }
    });
</script>

<script type="text/javascript">
    (function () {
        emailjs.init({
            publicKey: "fnRsuSaOIFbBxKzfa",
        });
    })();

    function sendMail() {
        const nameInput = document.getElementById("name");
        const emailInput = document.getElementById("email");
        const experienceInput = document.getElementById("experience");
        const rateInput = document.querySelector('input[name="rate"]:checked');

        if (!rateInput) {
            console.log("Please select a rate.");
            return;
        }

        let params = {
            name: nameInput.value,
            email: emailInput.value,
            experience: experienceInput.value,
            rate: rateInput.value,
        };

        const serviceID = "service_eicv53l";
        const templateID = "template_rm0ea19";

        if (rateInput.value < 5) {
            emailjs
                .send(serviceID, templateID, params)
                .then((res) => {
                    nameInput.value = "";
                    emailInput.value = "";
                    experienceInput.value = "";
                    document.querySelector('input[name="rate"]:checked').checked = false;
                    console.log(res);
                })
                .catch((err) => console.log(err));
        }
    }

</script>
</body>
</html>
