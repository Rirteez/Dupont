document.addEventListener('DOMContentLoaded', function() {
    let calendarEl = document.getElementById('calendar');
  
    let calendar = new FullCalendar.Calendar(calendarEl, {
      // format du calendrier
      initialView: 'dayGridMonth',
      // langue
      locale: 'fr',
      // jour à cacher (0 = dimanche, samedi = 6)
      hiddenDays: [0],
      // theme du calendrier
      themeSystem: 'bootstrap5',
      // barre d'outils
      headerToolbar: {
        left: 'prev today',
        center: 'title',
        right: 'next'
      },
      // traduction manuel des boutons
      buttonText: {
        today: 'Aujourd\'hui'
      },
      // format du titre 
      titleFormat: { 
        year: 'numeric', 
        month: 'long' 
      },
      // taille
      height: 'auto',
      // nombre d'event maximum a afficher par cellule (au dela sera ecrit "+N more")
      dayMaxEventRows: 2,
      //  evenement a afficher
      events: {
        url: '/api/getEvents.php',
        failure: function() {
          alert('Il y a eu un problème lors du chargement des rendez-vous.');
        }
      },
      selectable: false, 
      editable: false, 
      // faire afficher une div plutot que du text pour les event
      eventContent: function(arg) {
          return { html: `<div class="event-cell">${arg.event.title}</div>` }; // Utilisez une div pour la cellule
      },
      eventDidMount: function(info) {

        let eventStart = new Date(info.event.start);
        let currentMonth = new Date(info.view.currentStart).getMonth();

        if (eventStart.getMonth() === currentMonth) {
          // Appliquez un style spécifique aux événements du mois suivant
          info.el.classList.add('event-cell-current-month');
        } else {
          info.el.classList.add('event-cell-other-month');
        }
      },
      // evenement:hover
      eventMouseEnter: function(info) {
        var tooltip = document.createElement('div');
        tooltip.className = 'tooltip';
        tooltip.style.position = 'absolute';
        tooltip.style.background = '#333';
        tooltip.style.color = '#fff';
        tooltip.style.backgroundColor = '#1F5C67'
        tooltip.style.padding = '5px';
        tooltip.style.borderRadius = '0.375em';
        tooltip.style.zIndex = '10001';
        tooltip.innerHTML = info.event.title + '<br>' +
                            'Début: ' + info.event.start.toLocaleString() + '<br>' +
                            'Type de soins : ' + (info.event.extendedProps.description);

        document.body.appendChild(tooltip);

        tooltip.style.left = info.jsEvent.pageX + 'px';
        tooltip.style.top = info.jsEvent.pageY + 'px';

        info.el.tooltip = tooltip;
      },
      eventMouseLeave: function(info) {
          if (info.el.tooltip) {
              info.el.tooltip.remove();
              info.el.tooltip = null;
          }
      },
      // Ouvrir/fermer la div de modification/suppression ou changer les infos dans la div si clique sur un autre event
      eventClick: function(info) {
        let eventInteract = document.getElementById('eventInteract');
        let idRdvInput = eventInteract.querySelector('input[name=id_rdv_update]');
        let idRdvInput2 = eventInteract.querySelector('input[name=id_rdv_del]');
        let idpatient = document.getElementById('idpatient');
        let deleteForm = document.getElementById('deleteForm');

        
        if (eventInteract.classList.contains('show') && idRdvInput.value === info.event.id) {
            eventInteract.classList.remove('show'); 
        } else {
            deleteForm.setAttribute('data-id', info.event.id);
            idpatient.innerText = info.event.title;
            idRdvInput.value = info.event.id; 
            idRdvInput2.value = info.event.id; 
            eventInteract.querySelector('input[name=date_rdv_update]').value = info.event.start.toISOString().split('T')[0];
            eventInteract.querySelector('input[name=heure_rdv_update]').value = info.event.start.toLocaleTimeString([], {hour: '2-digit', minute: '2-digit'});
            eventInteract.querySelector('input[name=user_rdv_update]').value = info.event.extendedProps.id_user;

            // Sélectionner l'option du service
            let id_service = info.event.extendedProps.id_service; 
            let serviceSelect = eventInteract.querySelector('select[name=service_rdv_update]');
            
            // Définir l'option sélectionnée en fonction de l'ID du service
            if (id_service) {
                serviceSelect.value = id_service;
            }

            eventInteract.classList.add('show'); 
        }
      }
    });
    
    // Rendu du calendrier
    calendar.render();
  });