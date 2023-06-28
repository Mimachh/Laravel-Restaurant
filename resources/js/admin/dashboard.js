import '../../css/public/utility/fonts.scss';
import '../../css/public/utility/buttons.scss';


import '../../css/admin/modules/form.scss';
import '../../css/admin/modules/alert.scss';

import '../../css/admin/baseline/variables.scss';


import '../../css/admin/dashboard.scss';
import '../../css/admin/users.scss';





// USER SELECTION CHECKBOX

const selectAllCheckbox = document.getElementById('select-all');
const userCheckboxes = document.querySelectorAll('input[name="selected_users[]"]');

selectAllCheckbox.addEventListener('change', function () {
    const isChecked = selectAllCheckbox.checked;

    userCheckboxes.forEach(function (checkbox) {
        checkbox.checked = isChecked;
    });
});

