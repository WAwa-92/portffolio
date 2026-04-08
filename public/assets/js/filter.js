document.addEventListener('DOMContentLoaded', function () {
    var buttons = document.querySelectorAll('.filter-btn');
    var cards = document.querySelectorAll('.project-card');

    if (!buttons.length || !cards.length) {
        return;
    }

    buttons.forEach(function (button) {
        button.addEventListener('click', function () {
            var selected = button.dataset.filter;

            cards.forEach(function (card) {
                if (selected === 'all' || selected === card.dataset.category) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
});

