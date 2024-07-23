@extends('main')

@section('head')
    <?php
    $seotools = app('seotools');
    $metatags = app('seotools.metatags');
    $twitter = app('seotools.twitter');
    $opengraph = app('seotools.opengraph');
    $jsonld = app('seotools.json-ld');
    $jsonldMulti = app('seotools.json-ld-multi');

    echo app('seotools')->generate();
    ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/10.6.4/math.js"
        integrity="sha512-BbVEDjbqdN3Eow8+empLMrJlxXRj5nEitiCAK5A1pUr66+jLVejo3PmjIaucRnjlB0P9R3rBUs3g5jXc8ti+fQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <style>
        .calculator {
            padding: 10px;
            border-radius: 1em;
            height: 380px;
            max-width: 500px;
            width: 100%;
            margin: auto;
            background-color: #191b28;
            box-shadow: rgba(0, 0, 0, 0.19) 0px 10px 20px, rgba(0, 0, 0, 0.23) 0px 6px 6px;
        }

        .display-box {
            font-family: 'Orbitron', sans-serif;
            background-color: #dcdbe1;
            border: solid black 0.5px;
            color: black;
            border-radius: 5px;
            width: 100%;
            height: 65%;
        }

        #btn {
            background-color: #fb0066;
        }

        input[type=button] {
            font-family: 'Orbitron', sans-serif;
            background-color: #276b8f;
            color: white;
            border: solid black 0.5px;
            width: 100%;
            border-radius: 5px;
            height: 70%;
            outline: none;
        }

        input:active[type=button] {
            background: #e5e5e5;
            -webkit-box-shadow: inset 0px 0px 5px #c1c1c1;
            -moz-box-shadow: inset 0px 0px 5px #c1c1c1;
            box-shadow: inset 0px 0px 5px #c1c1c1;
        }
    </style>
@endsection

@section('content')
    <div id="app">
        <div class="header-content">
            <h1>Free Calculator</h1>
        </div>
        <div class="container">
            <div class="row bg-white">
                <section class="col-md-12">
                    <div class="">

                        <table class="calculator">
                            <tr>
                                <td colspan="3"> <input class="display-box" type="text" id="result" disabled /> </td>

                                <!-- clearScreen() function clears all the values -->
                                <td> <input type="button" value="C" onclick="clearScreen()" id="btn" /> </td>
                            </tr>
                            <tr>
                                <!-- display() function displays the value of clicked button -->
                                <td> <input type="button" value="1" onclick="display('1')" /> </td>
                                <td> <input type="button" value="2" onclick="display('2')" /> </td>
                                <td> <input type="button" value="3" onclick="display('3')" /> </td>
                                <td> <input type="button" value="/" onclick="display('/')" /> </td>
                            </tr>
                            <tr>
                                <td> <input type="button" value="4" onclick="display('4')" /> </td>
                                <td> <input type="button" value="5" onclick="display('5')" /> </td>
                                <td> <input type="button" value="6" onclick="display('6')" /> </td>
                                <td> <input type="button" value="-" onclick="display('-')" /> </td>
                            </tr>
                            <tr>
                                <td> <input type="button" value="7" onclick="display('7')" /> </td>
                                <td> <input type="button" value="8" onclick="display('8')" /> </td>
                                <td> <input type="button" value="9" onclick="display('9')" /> </td>
                                <td> <input type="button" value="+" onclick="display('+')" /> </td>
                            </tr>
                            <tr>
                                <td> <input type="button" value="." onclick="display('.')" /> </td>
                                <td> <input type="button" value="0" onclick="display('0')" /> </td>

                                <!-- calculate() function evaluates the mathematical expression -->
                                <td> <input type="button" value="=" onclick="calculate()" id="btn" /> </td>
                                <td> <input type="button" value="*" onclick="display('*')" /> </td>
                            </tr>
                        </table>
                    </div>
                </section>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // This function clears all the values
        function clearScreen() {
            document.getElementById("result").value = "";
        }

        // This function displays the values
        function display(value) {
            document.getElementById("result").value += value;
        }

        // This function evaluates the expression and returns the result
        function calculate() {
            var p = document.getElementById("result").value;
            var q = eval(p);
            document.getElementById("result").value = q;
        }

        function clearScreen() {
            document.getElementById("result").value = "";
        }

        function display(value) {
            document.getElementById("result").value += value;
        }
    </script>
@endsection
