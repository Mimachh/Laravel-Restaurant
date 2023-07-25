@props(['title' => "Titre", "class" => "", "targetId" => "", "type" => "scroll"])

<button
    class=" px-4 md:px-6 py-2 md:py-3 text-md md:text-xl rounded-md font-quicksand font-bold 

    transition-colors ease-in-out duration-150
    {{ $class }}
    "

  @if ($type === 'scroll')
    onclick="scrollToElement('{{ $targetId }}')"
  @elseif ($type === 'modalEmporter')
    onClick="openModalEmporter()"
  @elseif ($type === 'modal')
    onClick="openModal()"
  @elseif($type === "link")
    onClick="openLinkInNewTab('{{ $targetId }}')"
  @endif
>{{ $title }}</button>

<script>
    function scrollToElement(id) {
    const element = document.getElementById(id);
    if (element) {
      element.scrollIntoView({ behavior: 'smooth' });
    }
}


function openModal() {
  // Ajoutez ici le code pour afficher la modale
  console.log('Ouvrir la modale');
  const modale = document.getElementById('modalResa');
  modale.classList.toggle('hidden');

 modale.showModal();
}

function openModalEmporter() {
  // Ajoutez ici le code pour afficher la modale
  console.log('Ouvrir la modale à emporter');
}

function openLinkInNewTab(url) {
  window.open(url, '_blank');
}
</script>