
const search = document.querySelector('.input-group input'),
    table_rows = document.querySelectorAll('tbody tr'),
    table_headings = document.querySelectorAll('thead th');

// 1. Searching for specific data of HTML table
search.addEventListener('input', searchTable);

function searchTable() {
    table_rows.forEach((row, i) => {
        let table_data = row.textContent.toLowerCase(),
            search_data = search.value.toLowerCase();

        row.classList.toggle('hide', table_data.indexOf(search_data) < 0);
        row.style.setProperty('--delay', i / 25 + 's');
    })

    document.querySelectorAll('tbody tr:not(.hide)').forEach((visible_row, i) => {
        visible_row.style.backgroundColor = (i % 2 == 0) ? 'transparent' : '#0000000b';
    });
}

// 2. Sorting | Ordering data of HTML table


function sortTable(column, sort_asc) {
    let table_rows = document.querySelectorAll('tbody tr');
    // alert('aqui');

    [...table_rows].sort((a, b) => {
        let idColumnName = 'id';
        let isIDColumn = (document.querySelectorAll('th')[column].id === idColumnName);
        // let idColumnQuantidade = 'quantidade';
        // let isQuantidadeColumn = (document.querySelectorAll('th')[column].id === idColumnQuantidade);
        let first_row, second_row;

        if (isIDColumn) {
            first_row =  parseInt(a.querySelectorAll('td')[column].textContent);
            //  : parseFloat(a.querySelectorAll('td')[column].textContent);
            second_row = parseInt(b.querySelectorAll('td')[column].textContent) ;
            // : parseFloat(b.querySelectorAll('td')[column].textContent);
        } else {
            first_row = a.querySelectorAll('td')[column].textContent.toLowerCase();
            second_row = b.querySelectorAll('td')[column].textContent.toLowerCase();
        }


        return sort_asc ? (first_row < second_row ? 1 : -1) : (first_row < second_row ? -1 : 1);
    })
        .map(sorted_row => document.querySelector('tbody').appendChild(sorted_row));
}

function handleSort(head, i) {
    let sort_asc = true;
    head.onclick = () => {
        let table_headings = document.querySelectorAll('th');
        table_headings.forEach(head => head.classList.remove('active'));
        head.classList.add('active');

        document.querySelectorAll('td').forEach(td => td.classList.remove('active'));
        let table_rows = document.querySelectorAll('tbody tr');
        table_rows.forEach(row => {
            row.querySelectorAll('td')[i].classList.add('active');
        })

        head.classList.toggle('asc', sort_asc);
        sort_asc = head.classList.contains('asc') ? false : true;

        sortTable(i, sort_asc);
    }
}

// Adicione esta linha dentro do seu script para chamar handleSort() para cada cabeçalho da tabela
document.querySelectorAll('th').forEach((head, i) => {
    handleSort(head, i);
});


const changeTheme = () =>{
    alert('aqui');
}




