@extends('content-adm.dashboard.shared.layout')

<div class="default-space-between">

    <h1>Logs de criação/alteração de dados do sistema</h1>

    <p><b>Todos os dados cadastrados pelo gestor são exibidos aqui.</b></p>

    <div class="table-responsive">
        <table class="table" id="dataTable" data-order='[[0, "desc"]]' width="100%" cellspacing="0">

            <thead>
                <tr>
                    <th><b>ID</b></th>
                    <th>Mensagem</th>
                    <th>Criado em</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($logs as $log)
                @php
                $log['created_at'] = date("d/m/Y H:i:s", strtotime($log['created_at']));
                @endphp

                <tr>
                    <td><b>{{$log['id']}}<b></td>
                    <td>{{$log['message']}}</td>
                    <td>{{$log['created_at']}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>