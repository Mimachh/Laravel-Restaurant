

    // OPEN RESA
    const is_online_booking = document.getElementById('is_online_booking');
    const options_if_resa_online_is_open = document.querySelectorAll('.options_if_resa_online_is_open');
    // VALIDATION
    const is_automatic_validation = document.getElementById('is_automatic_validation');
    const options_if_validation_auto_is_open = document.querySelectorAll('.options_if_validation_auto_is_open');
    // ADD LIMIT    
    const is_add_manual_validation = document.getElementById('is_add_manual_validation');
    const options_if_add_limit_is_open = document.querySelector('.options_if_add_limit_is_open');
    
        function toggleAddLimit() {
            if(is_online_booking.checked && is_automatic_validation.checked && is_add_manual_validation.checked) {
                options_if_add_limit_is_open.style.display = 'table-row';
            } else {
                options_if_add_limit_is_open.style.display = "none";
            }
        }
        is_add_manual_validation.addEventListener('change', function() {
            toggleAddLimit();
    
        });

        
        function toggleAutomaticValidation() {
            options_if_validation_auto_is_open.forEach(function(options_if_validation_auto_is_open) {
                if(is_online_booking.checked && is_automatic_validation.checked) {
                    options_if_validation_auto_is_open.style.display = 'table-row';
                } else {
                    options_if_validation_auto_is_open.style.display = "none";
                }

                if(is_add_manual_validation.checked && is_online_booking.checked && is_automatic_validation.checked) {
                    options_if_add_limit_is_open.style.display = 'table-row';
                } else {
                    options_if_add_limit_is_open.style.display = "none";
                }
            });
        }
        toggleAutomaticValidation();

        is_automatic_validation.addEventListener('change', function() {
            toggleAutomaticValidation();
    
        });



    function toggleOptionsResa() {
        options_if_resa_online_is_open.forEach(function(options_if_resa_online_is_open) {
            if (is_online_booking.checked) {
                options_if_resa_online_is_open.style.display = 'table-row';
            } else {
                options_if_resa_online_is_open.style.display = 'none';

                toggleAutomaticValidation();
            }
        });
    }

    toggleOptionsResa();
    is_online_booking.addEventListener('change', function() {
        toggleOptionsResa();


        options_if_validation_auto_is_open.forEach(function(options_if_validation_auto_is_open) {
            if(is_online_booking.checked && is_automatic_validation.checked) {
                options_if_validation_auto_is_open.style.display = 'table-row';
            } else {
                options_if_validation_auto_is_open.style.display = "none";
            }
        });

        if(is_add_manual_validation.checked && is_online_booking.checked && is_automatic_validation.checked) {
            options_if_add_limit_is_open.style.display = 'table-row';
        } else {
            options_if_add_limit_is_open.style.display = "none";
        }
    });

