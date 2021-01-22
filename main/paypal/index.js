paypal.Buttons({
    style: {
        color: 'blue',
        shape: 'pill'
    },
    createOrder: function(data, actions) {
        return actions.order.create({
            purchase_units: [{
                amount: {
                    value: '0.1'
                }
            }]
        });
    },
    onApprove: function(data, actions) {

        return actions.order.capture().then(function(details) {
            var time_payment = details.update_time;
            var id = details.id;
            var status = details.status;
            const abc = 27;
            console.log(abc);

            // document.getElementById('#amount').innerHTML = details.purchase_units.amount.value;
            // document.getElementById('#').innerHTML = details.;


            console.log(details)

             window.location.replace("http://localhost/learner/main/paypal/sucess.php?status=" + status + "&id=" + abc + "&date=" + time_payment)
             // window.location.replace("http://localhost/learner/main/main.php);
        });


    },
    onCancel: function(data) {

        window.location.replace("http://localhost/learner/main/paypal/cancel.php")

    }

}).render('#paypl');