document.addEventListener('DOMContentLoaded', () => {
    const buttons = document.querySelectorAll('.filter-btn');
    const cards = document.querySelectorAll('.project-card');

    if (!buttons.length || !cards.length) {
        return;
    }

    buttons.forEach((button) => {
        button.addEventListener('click', () => {
            const selected = button.dataset.filter;

            cards.forEach((card) => {
                const cardCategory = card.dataset.category;
                const shouldShow = selected === 'all' || selected === cardCategory;
                card.style.display = shouldShow ? 'block' : 'none';
            });
        });
    });
});
