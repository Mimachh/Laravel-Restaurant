// function toggleCheckboxList() {
//     var checkboxList = document.getElementById('entreesCheckboxList');
//     var toggleSpanPlus = document.querySelector('.toggleSpanPlus');
//     var toggleSpanMinus = document.querySelector('.toggleSpanMinus');

//     if (checkboxList.style.display === 'none') {
//         checkboxList.style.display = 'block';
//         toggleSpanPlus.classList.add('hidden');
//         toggleSpanMinus.classList.remove('hidden');

//     } else {
//         checkboxList.style.display = 'none';
//         toggleSpanPlus.classList.remove('hidden');

//         toggleSpanMinus.classList.add('hidden');

//     }
// }

function toggleCheckboxList(elementId, toggleClass, itemPlus, itemMinus) {
    var checkboxList = document.getElementById(elementId);
    var toggleSpanPlus = document.getElementById(itemPlus);
    var toggleSpanMinus = document.getElementById(itemMinus);
  
    if (checkboxList.style.display === 'none') {
      checkboxList.style.display = 'block';
      toggleSpanPlus.classList.add('hidden');
      toggleSpanMinus.classList.remove('hidden');
    } else {
      checkboxList.style.display = 'none';
      toggleSpanPlus.classList.remove('hidden');
      toggleSpanMinus.classList.add('hidden');
    }
  }