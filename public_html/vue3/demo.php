<html>
<head>
    <script src="vue.js"></script>
</head>

<body>

<div id="comp1">
    <ol>
        <todo-item v-for="item in groceryList" v-bind:todo="item" v-bind:key="item.id">
        </todo-item>
    </ol>
</div>

<script>

    // http://local.labs.se/vue/comp1.php

    // This example show how to create a component that you can reuse
    // On the top we use the <todo-item>
    // Below here we register the "todo-item"

    Vue.component('todo-item', {
        props: ['todo'],
        template: '<li>{{ todo.text }}</li>'
    });

    // Here we give data to the component.

    let comp1 = new Vue({
        el: '#comp1',
        data: {
            groceryList: [
                { id: 0, text: 'Vegetables' },
                { id: 1, text: 'Cheese' },
                { id: 2, text: 'Whatever else humans are supposed to eat' }
            ]
        }
    });

</script>

</body>
</html>