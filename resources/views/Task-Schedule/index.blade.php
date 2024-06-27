@extends('layouts.app')
@section('content')
<div class="container">
    <header class="header">
        <h1>To Do List</h1>
    </header>
    <div class="content">
        <span class="error-el error-msg-title"></span>
        <div class="add-task">
           <input type="text" placeholder="Add your new todo" class="input" id="addTaskInput">
           <input type="hidden" id="taskID">
            <button class="add-button" id="addTask">+</button>
        </div>
        <ul class="task-list"></ul>
        <div class="task-footer">
            <p></p>
            <button class="clear-all-button">Clear All</button>
        </div>
    </div>
</div>
@stop
