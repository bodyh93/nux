@extends('base')
<style>
    body {
        background-color: #f8f9fa;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }

    .main {
        width: 500px !important;
        margin-top: 5%;
    }

    .result-card {
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        text-align: center;
        margin-top: 20px;
    }

    .result-prize {
        font-size: 40px;
        font-weight: bold;
        margin: 10px 0;
        opacity: 0;
    }

    .result-status {
        font-size: 24px;
        font-weight: bold;
        opacity: 0;
    }

    .result-number {
        font-size: 40px;
        color: #0d6efd;
        opacity: 0;
    }

    .win {
        color: #64fb64;
        display: none;
    }

    .lose {
        color: lightcoral;
        display: none;
    }

    .arrow-up {
        width: 0;
        height: 0;
        border-left: 20px solid transparent;
        border-right: 20px solid transparent;
        border-bottom: 20px solid #198754;
        margin: 20px auto;
    }
</style>
<div class="main container container-sm text-center">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <button type="button" class="btn btn-success" id="play">I'm Feeling Lucky</button>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="result-card">
                <div id="click-it">
                    <div class="arrow-up"></div>
                    <div>CLICK</div>
                </div>
                <div class="result-number" id="result-number"></div>
                <div class="result-status" id="result-status"><span class="win">WIN</span><span class="lose">lose</span>
                </div>
                <div class="result-prize" id="result-prize">0</div>
            </div>
        </div>
    </div>
    <div class="container" style="text-align: right; margin-top: 40px">
        <button type="button" class="btn btn-secondary" id="history" data-bs-toggle="modal"
                data-bs-target="#historyModal">
            History
        </button>
    </div>
    <div class="container" style="text-align: right; margin-top: 40px">
        <button type="button" class="btn btn-primary" id="new-link">New Link</button>
        <button type="button" class="btn btn-primary" id="deactivate-link">Deactivate Link</button>
    </div>
</div>
<div class="modal fade" tabindex="-1" id="historyModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Your game history</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Number</th>
                            <th scope="col">Win</th>
                            <th scope="col">Win amount</th>
                        </tr>
                    </thead>
                    <tbody id="history-table-body">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('history').addEventListener('click', () => {
        fetch('/ajax/game/history')
            .then(response => {
                if (response.ok) {
                    return response.json();
                }
            })
            .then(data => {
                let tableBody = document.getElementById('history-table-body');
                tableBody.innerHTML = '';
                data.forEach(game => {
                    let row = document.createElement('tr');
                    let numberCell = document.createElement('td');
                    numberCell.textContent = game.number;
                    row.appendChild(numberCell);

                    let winCell = document.createElement('td');
                    winCell.textContent = game.win ? 'Win' : 'Lose';
                    row.appendChild(winCell);

                    let winAmountCell = document.createElement('td');
                    winAmountCell.textContent = game.winAmount;
                    row.appendChild(winAmountCell);

                    tableBody.appendChild(row);
                });
            })
            .catch(error => {
                alert('Error! See console.');
                console.error(error);
            });
    });
    document.getElementById('play').addEventListener('click', () => {
        fetch('/ajax/game/play')
            .then(response => {
                if (response.ok) {
                    return response.json();
                }
            })
            .then(data => {
                document.getElementById('click-it').style.display = 'none';
                document.getElementById('result-number').style.opacity = '1';
                document.getElementById('result-number').innerHTML = data.number;
                document.getElementById('result-status').style.opacity = '1';
                document.getElementById('result-prize').style.color = data.win ? '#64fb64' : 'lightcoral';
                document.getElementById('result-prize').style.opacity = '1';
                if (data.win) {
                    document.getElementById('result-status').getElementsByClassName('win')[0].style.display = 'block';
                    document.getElementById('result-status').getElementsByClassName('lose')[0].style.display = 'none';
                } else {
                    document.getElementById('result-status').getElementsByClassName('win')[0].style.display = 'none';
                    document.getElementById('result-status').getElementsByClassName('lose')[0].style.display = 'block';
                }
                document.getElementById('result-prize').innerHTML = data.winAmount;
            })
            .catch(error => {
                alert('Error! See console.');
                console.error(error);
            });
    });
    document.getElementById('new-link').addEventListener('click', () => {
        window.location.href = '/link/new';
    });
    document.getElementById('deactivate-link').addEventListener('click', () => {
        window.location.href = '/link/deactivate';
    });
</script>
