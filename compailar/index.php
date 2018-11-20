<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <?php include "header.php"; ?>

  <title>Judge0 IDE</title>
  <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
  <link rel="icon" href="./favicon.ico" type="image/x-icon">
</head>

<body>
  <nav class="navbar navbar-default navbar-static-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="https://ide.judge0.com">
          Judge0 IDE
        </a>
      </div>
      <ul class="nav navbar-nav navbar-left">
        <li><a id="apiLink" target="_blank" href=""></a></li>
      </ul>
      <div class="navbar-form navbar-right">
        <div class="input-group">
          <div class="input-group-btn">
            <button id="insertTemplateBtn" type="button" class="btn btn-default" data-toggle="tooltip" data-placement="bottom" title="Insert template">
              <span class="glyphicon glyphicon-file" aria-hidden="true"></span>
            </button>
          </div>
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
        </div>
        <button class="btn btn-success" onclick="submit()" id="runBtn" data-loading-text="Running...">
          <span class="glyphicon glyphicon-play" aria-hidden="true"></span> Run (F9)
        </button>
        <button class="btn btn-primary" id="saveBtn" data-loading-text="Saving...">
          <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Save (Ctrl+S)
        </button>
        <button class="btn btn-default" id="downloadSourceBtn" data-toggle="tooltip" data-placement="bottom" title="Download source">
          <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>
        </button>
        <div class="vertical-spacer"></div>
        <input type="checkbox" id="vimCheckBox" data-toggle="toggle" data-on="Vim Mode On" data-off="Vim Mode Off" data-onstyle="success">
      </div>
    </div>
  </nav>

  <div id="sourceEditor"></div>

  <div class="container-fluid">
    <div class="row labels">
      <div id="inputLabel" class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <h4>
          <span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Input <small>optional</small>
          <button class="btn btn-default pull-right" id="downloadInputBtn" data-toggle="tooltip" data-placement="top" title="Download input">
            <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>
          </button>
        </h4>
      </div>
      <div id="outputLabel" class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
        <h4>
          <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Output <small id="emptyIndicator">empty</small>
          <button class="btn btn-default pull-right" id="downloadOutputBtn" data-toggle="tooltip" data-placement="top" title="Download output">
            <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span>
          </button>
          <small class="pull-right" id="statusLine"></small>
        </h4>
      </div>
    </div>

    <div class="row ioEditors">
      <div id="inputEditor"  class="col-xs-6 col-sm-6 col-md-6 col-lg-6"></div>
      <div id="outputEditor" class="col-xs-6 col-sm-6 col-md-6 col-lg-6"></div>
    </div>
<textarea type="text" id="input_ex" placeholder="input" name=""></textarea>
<textarea  type="text" id="output_ex" name=""></textarea>
<textarea  type="text" id="output_normal" placeholder="output" name=""></textarea>
<button onclick="submit()">Submit</button>

    <div id="judge_custom" style="padding: 15px" class="judge_custom_st">fgdh</div>

    <div class="row">
      <div id="footer" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <p>
          © 2017 <a href="https://judge0.com">Judge0</a>,
          Powered by <a href="https://api.judge0.com">Judge0 API</a>,
          Available on <a href="https://github.com/judge0/ide">GitHub</a>
        </p>
      </div>
    </div>
  </div>
</body>
</html>
#include<bits/stdc++.h>
using namespace std;
int main(){
  int a,b;
  cin >> a >> b;
  cout << a+b << "\n";
}