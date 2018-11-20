<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">

<style type="text/css">
    .editor{
        width: 800px;
        height: auto;
        border-color: #eeeeee;
        border-style: solid;
        border-width: 2px;
    }
</style>

<?php

$info=$judge_status_ob->get_runable_problem_test();

echo "<pre>";
//print_r($problems_info);
echo "</pre>";
print_r($info);

?>

<div class="row" style="margin-top: 30px;">
    <div class="col-md-1"></div>
    <div class="col-md-10" id="status_list" style="text-align: center;">

    </div>
    <div class="col-md-1"></div>
</div>


<textarea id="output"></textarea>

    <textarea id="input" name="code"></textarea>
    <input type="submit" onclick="get_test_case()" name="btn">


<div class="row" style="margin-top: 30px;">
    <div class="col-md-2"></div>
    <div class="col-md-7">
        <select class="form-control" id="selectLanguageBtn">
            <option value="1" mode="text/x-sh">Bash (4.4)</option>
            <option value="2" mode="text/x-sh">Bash (4.0)</option>
            <option value="3" mode="text/x-pascal">Basic (fbc 1.05.0)</option>
            <option value="4" mode="text/x-csrc">C (gcc 7.2.0)</option>
            <option value="5" mode="text/x-csrc">C (gcc 6.4.0)</option>
            <option value="6" mode="text/x-csrc">C (gcc 6.3.0)</option>
            <option value="7" mode="text/x-csrc">C (gcc 5.4.0)</option>
            <option value="8" mode="text/x-csrc">C (gcc 4.9.4)</option>
            <option value="9" mode="text/x-csrc">C (gcc 4.8.5)</option>
            <option value="10" mode="text/x-c++src">C++ (g++ 7.2.0)</option>
            <option value="11" mode="text/x-c++src">C++ (g++ 6.4.0)</option>
            <option value="12" mode="text/x-c++src">C++ (g++ 6.3.0)</option>
            <option value="13" mode="text/x-c++src">C++ (g++ 5.4.0)</option>
            <option value="14" mode="text/x-c++src">C++ (g++ 4.9.4)</option>
            <option value="15" mode="text/x-c++src">C++ (g++ 4.8.5)</option>
            <option value="16" mode="text/x-csharp">C# (mono 5.4.0.167)</option>
            <option value="17" mode="text/x-csharp">C# (mono 5.2.0.224)</option>
            <option value="18" mode="text/x-clojure">Clojure (1.8.0)</option>
            <option value="19" mode="text/x-crystal">Crystal (0.23.1)</option>
            <option value="20" mode="text/x-elixir">Elixir (1.5.1)</option>
            <option value="21" mode="text/x-erlang">Erlang (OTP 20.0)</option>
            <option value="22" mode="text/x-go">Go (1.9)</option>
            <option value="23" mode="text/x-haskell">Haskell (ghc 8.2.1)</option>
            <option value="24" mode="text/x-haskell">Haskell (ghc 8.0.2)</option>
            <option value="25" mode="text/plain">Insect (5.0.0)</option>
            <option value="26" mode="text/x-java">Java (OpenJDK 9 with Eclipse OpenJ9)</option>
            <option value="27" mode="text/x-java">Java (OpenJDK 8)</option>
            <option value="28" mode="text/x-java">Java (OpenJDK 7)</option>
            <option value="29" mode="text/javascript">JavaScript (nodejs 8.5.0)</option>
            <option value="30" mode="text/javascript">JavaScript (nodejs 7.10.1)</option>
            <option value="31" mode="text/x-ocaml">OCaml (4.05.0)</option>
            <option value="32" mode="text/x-octave">Octave (4.2.0)</option>
            <option value="33" mode="text/x-pascal">Pascal (fpc 3.0.0)</option>
            <option value="34" mode="text/x-python">Python (3.6.0)</option>
            <option value="35" mode="text/x-python">Python (3.5.3)</option>
            <option value="36" mode="text/x-python">Python (2.7.9)</option>
            <option value="37" mode="text/x-python">Python (2.6.9)</option>
            <option value="38" mode="text/x-ruby">Ruby (2.4.0)</option>
            <option value="39" mode="text/x-ruby">Ruby (2.3.3)</option>
            <option value="40" mode="text/x-ruby">Ruby (2.2.6)</option>
            <option value="41" mode="text/x-ruby">Ruby (2.1.9)</option>
            <option value="42" mode="text/x-rustsrc">Rust (1.20.0)</option>
            <option value="43" mode="text/plain">Text (plain text)</option>
          </select>
    <div  class="editor">
    <div id="sourceEditor"></div>
    </div>
    <center>
    <button onclick="submit_solution(4,1)">Submit</button>
    </center>
    <div id="problems_responce"></div>
    </div>
    <div class="col-md-3"></div>
</div>



