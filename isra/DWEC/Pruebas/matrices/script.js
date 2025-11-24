document.getElementById('generate-btn').addEventListener('click', function () {
    const n = parseInt(document.getElementById('dimension').value);
    const container = document.getElementById('matrix-container');

    container.innerHTML = '';

    if (isNaN(n) || n < 1) {
        container.textContent = 'Pon un número mayor que 0.';
        return;
    }

    const table = document.createElement('table');

    for (let i = 0; i < n; i++) {
        const tr = document.createElement('tr');
        for (let j = 0; j < n; j++) {
            const td = document.createElement('td');
            if (i === j) {
                td.textContent = '1';
                td.classList.add('diagonal');
            } else {
                td.textContent = '0';
            }
            tr.appendChild(td);
        }
        table.appendChild(tr);
    }

    container.appendChild(table);
});

document.getElementById('transpose-btn').addEventListener('click', function () {
    const originalContainer = document.getElementById('original-matrix');
    const transposedContainer = document.getElementById('transposed-matrix');

    originalContainer.innerHTML = '';
    transposedContainer.innerHTML = '';

    const matrix = [];
    let count = 1;
    for (let i = 0; i < 3; i++) {
        const row = [];
        for (let j = 0; j < 3; j++) {
            row.push(count++);
        }
        matrix.push(row);
    }

    originalContainer.appendChild(createTableFromMatrix(matrix));

    const transpose = [];
    for (let i = 0; i < 3; i++) {
        const row = [];
        for (let j = 0; j < 3; j++) {
            row.push(matrix[j][i]);
        }
        transpose.push(row);
    }

    transposedContainer.appendChild(createTableFromMatrix(transpose));
});

function createTableFromMatrix(matrix) {
    const table = document.createElement('table');
    for (let i = 0; i < matrix.length; i++) {
        const tr = document.createElement('tr');
        for (let j = 0; j < matrix[i].length; j++) {
            const td = document.createElement('td');
            td.textContent = matrix[i][j];
            tr.appendChild(td);
        }
        table.appendChild(tr);
    }
    return table;
}
