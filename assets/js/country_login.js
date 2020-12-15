function country() {
    var xmlhttp = new XMLHttpRequest();
    var url = "../assets/country/country.json";
    xmlhttp.open("post", url, true);
    xmlhttp.send();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var myObj = JSON.parse(this.responseText);
            var myDiv = document.getElementById("myDiv");
            //Create and append select list
            var selectList = document.createElement("select");
            selectList.id = "country";
            selectList.name = "country";
            selectList.className = "custom-select d-block w-100";
            myDiv.appendChild(selectList);

            var ordered = {};
            Object.keys(myObj).sort().forEach(function (key) {
                ordered[key] = myObj[key];
            });
            // var ordered =Object.keys(myObj);
            // ordered.sort().forEach(function(key) {
            //     ordered[key] = myObj[key];
            // });

            for (var x in ordered) {
                var option = document.createElement("option");
                option.value = ordered[x];
                option.text = x;
                selectList.appendChild(option);
            }
            // console.log(ordered);
            // console.log(myObj);
        }
    };
    //    document.getElementById("select").addEventListener("keypress", rwandaMap); 
}
window.onload = country();