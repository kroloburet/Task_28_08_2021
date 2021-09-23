<div id="task2_result">
    <div>
        <h4>Невідсортовані данні</h4>
        Час виконання: <?= $task2_unsort['time'] ?> секунд.
        <textarea readonly><?php print_r($task2_unsort['data']) ?></textarea>
    </div>

    <div>
        <h4>Відсортовані данні</h4>
        Час виконання: <?= $task2_sort['time'] ?> секунд.
        <textarea readonly><?php print_r($task2_sort['data']) ?></textarea>
    </div>
</div>
