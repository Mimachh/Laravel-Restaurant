    // -------------------------------------- VACANCES ----------------------------- //
    const switchElement = document.getElementById('status');
    const formSection = document.getElementById('form-section');
    const tableElement = document.querySelector('.user-table');

    toggleFormSection(); // Appel initial pour afficher ou cacher la section en fonction de l'état de fermeture

    switchElement.addEventListener('change', function() {
        toggleFormSection();
    });

    function toggleFormSection() {
        if (switchElement.checked) {
            formSection.style.display = 'block';
            tableElement.style.display = 'none';
        } else {
            formSection.style.display = 'none';
            tableElement.style.display = 'table';
        }
    }
    
    

    
    // --------------------------------------- JOUR ------------------------------ //
    
    // Lundi midi
    const switchLundiMidi = document.getElementById('switch_lundi_midi_ouverture');
    const lundi_midi_div = document.getElementById('lundi_midi_div');
    
    toggleFormSectionFactorised(switchLundiMidi, lundi_midi_div);

    switchLundiMidi.addEventListener('change', function() {
        toggleFormSectionFactorised(switchLundiMidi, lundi_midi_div);
    });

    // Lundi soir
    const switchLundiSoir = document.getElementById('switch_lundi_soir_ouverture');
    const lundi_soir_div = document.getElementById('lundi_soir_div');
    
    toggleFormSectionFactorised(switchLundiSoir, lundi_soir_div);

    switchLundiSoir.addEventListener('change', function() {
        toggleFormSectionFactorised(switchLundiSoir, lundi_soir_div);
    });



    // Mardi midi
    const switchMardiMidi = document.getElementById('switch_mardi_midi_ouverture');
    const mardi_midi_div = document.getElementById('mardi_midi_div');
    
    toggleFormSectionFactorised(switchMardiMidi, mardi_midi_div);

    switchMardiMidi.addEventListener('change', function() {
        toggleFormSectionFactorised(switchMardiMidi, mardi_midi_div);
    });

    // Mardi soir
    const switchMardiSoir = document.getElementById('switch_mardi_soir_ouverture');
    const mardi_soir_div = document.getElementById('mardi_soir_div');
    
    toggleFormSectionFactorised(switchMardiSoir, mardi_soir_div);

    switchMardiSoir.addEventListener('change', function() {
        toggleFormSectionFactorised(switchMardiSoir, mardi_soir_div);
    });


    // Mercredi midi
    const switchMercrediMidi = document.getElementById('switch_mercredi_midi_ouverture');
    const mercredi_midi_div = document.getElementById('mercredi_midi_div');
    
    toggleFormSectionFactorised(switchMercrediMidi, mercredi_midi_div);

    switchMercrediMidi.addEventListener('change', function() {
        toggleFormSectionFactorised(switchMercrediMidi, mercredi_midi_div);
    });

    // Mercredi soir
    const switchMercrediSoir = document.getElementById('switch_mercredi_soir_ouverture');
    const mercredi_soir_div = document.getElementById('mercredi_soir_div');
    
    toggleFormSectionFactorised(switchMercrediSoir, mercredi_soir_div);

    switchMercrediSoir.addEventListener('change', function() {
        toggleFormSectionFactorised(switchMercrediSoir, mercredi_soir_div);
    });

    // Jeudi midi
    const switchJeudiMidi = document.getElementById('switch_jeudi_midi_ouverture');
    const jeudi_midi_div = document.getElementById('jeudi_midi_div');
    
    toggleFormSectionFactorised(switchJeudiMidi, jeudi_midi_div);

    switchJeudiMidi.addEventListener('change', function() {
        toggleFormSectionFactorised(switchJeudiMidi, jeudi_midi_div);
    });

    // Jeudi soir
    const switchJeudiSoir = document.getElementById('switch_jeudi_soir_ouverture');
    const jeudi_soir_div = document.getElementById('jeudi_soir_div');
    
    toggleFormSectionFactorised(switchJeudiSoir, jeudi_soir_div);

    switchJeudiSoir.addEventListener('change', function() {
        toggleFormSectionFactorised(switchJeudiSoir, jeudi_soir_div);
    });

    // Vendredi midi
    const switchVendrediMidi = document.getElementById('switch_vendredi_midi_ouverture');
    const vendredi_midi_div = document.getElementById('vendredi_midi_div');
    
    toggleFormSectionFactorised(switchVendrediMidi, vendredi_midi_div);

    switchVendrediMidi.addEventListener('change', function() {
        toggleFormSectionFactorised(switchVendrediMidi, vendredi_midi_div);
    });

    // Vendredi soir
    const switchVendrediSoir = document.getElementById('switch_vendredi_soir_ouverture');
    const vendredi_soir_div = document.getElementById('vendredi_soir_div');
    
    toggleFormSectionFactorised(switchVendrediSoir, vendredi_soir_div);

    switchVendrediSoir.addEventListener('change', function() {
        toggleFormSectionFactorised(switchVendrediSoir, vendredi_soir_div);
    });

    // Samedi midi
    const switchSamediMidi = document.getElementById('switch_samedi_midi_ouverture');
    const samedi_midi_div = document.getElementById('samedi_midi_div');
    
    toggleFormSectionFactorised(switchSamediMidi, samedi_midi_div);

    switchSamediMidi.addEventListener('change', function() {
        toggleFormSectionFactorised(switchSamediMidi, samedi_midi_div);
    });

    // Samedi soir
    const switchSamediSoir = document.getElementById('switch_samedi_soir_ouverture');
    const samedi_soir_div = document.getElementById('samedi_soir_div');
    
    toggleFormSectionFactorised(switchSamediSoir, samedi_soir_div);

    switchSamediSoir.addEventListener('change', function() {
        toggleFormSectionFactorised(switchSamediSoir, samedi_soir_div);
    });

    // Dimanche midi
    const switchDimancheMidi = document.getElementById('switch_dimanche_midi_ouverture');
    const dimanche_midi_div = document.getElementById('dimanche_midi_div');
    
    toggleFormSectionFactorised(switchDimancheMidi, dimanche_midi_div);

    switchDimancheMidi.addEventListener('change', function() {
        toggleFormSectionFactorised(switchDimancheMidi, dimanche_midi_div);
    });

    // Dimanche soir
    const switchDimancheSoir = document.getElementById('switch_dimanche_soir_ouverture');
    const dimanche_soir_div = document.getElementById('dimanche_soir_div');
    
    toggleFormSectionFactorised(switchDimancheSoir, dimanche_soir_div);

    switchDimancheSoir.addEventListener('change', function() {
        toggleFormSectionFactorised(switchDimancheSoir, dimanche_soir_div);
    });



    function toggleFormSectionFactorised(switchElement, formSection) {
    if (switchElement.checked) {
        formSection.style.display = 'block';
    } else {
        formSection.style.display = 'none';
    }

}
