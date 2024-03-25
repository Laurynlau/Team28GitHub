window.onload = (() => {
  let searchInput = document.getElementById("searchInput");
  if (searchInput) {
    searchInput.addEventListener("keydown", function (e) {
        if (e.key === "Enter") {  //checks whether the pressed key is "Enter"
            performSearch();
        }
    });
  }
});

let sidebarOpen = true;
const sidebar = document.getElementById('sidebar');

function openSidebar() {
  if (!sidebarOpen) {
    sidebar.classList.add('sidebar-responsive');
    sidebarOpen = true;
  }
}

function closeSidebar() {
  if (sidebarOpen) {
    sidebar.classList.remove('sidebar-responsive');
    sidebarOpen = false;
  }
}

// Based On: https://css-tricks.com/snippets/javascript/get-url-variables/
function parseQueryString(direction, dict) {
    // create dictionary of current querystring
    let query = window.location.search.substring(1);
    let vars = query.split("&");
    let queryDict = {};
    for (let i=0; i < vars.length; i++) {
        var pair = vars[i].split("=");
        if(pair.length == 2) {
          queryDict[pair[0]] = pair[1];
        }
    } 

    // returns the dictionary of current querystring
    if (direction == "in") {
        return queryDict;
    }

    // returns a querystring from the current or a new dictionary
    if (direction == "out") {
        let qString = "";

        if(!dict) {
            dict = queryDict;
        }

        let dictKeys = Object.keys(dict);
        for (let i = 0; i < dictKeys.length; i++) {
            let currentKey = dictKeys[i];
            if (i == 0) {
                qString += "?" + currentKey + "=" + dict[currentKey];
            } else {
                qString += "&" + currentKey + "=" + dict[currentKey];
            }
        }

        return qString;
    }
}

function performSearch() {
    let searchValue = document.getElementById("searchInput").value;
    let currentQSdict = parseQueryString("in");
    currentQSdict["title"] = searchValue;
    redirectByQS(currentQSdict);
}


function performFilter() {
    let categoryElement = document.getElementById("category");
    let priceElement = document.getElementById("price-range");
    let statusElement = document.getElementById("status");
    let totalElement = document.getElementById("total-range");
    
    let currentQSdict = parseQueryString("in");

    if (categoryElement)  {
      currentQSdict["category"] = categoryElement.value;
    }

    if (priceElement) {
      currentQSdict["price-range"] = priceElement.value;
    }

    if (statusElement) {
      currentQSdict["status"] = statusElement.value;
    }

    if (totalElement) {
      currentQSdict["total-range"] = totalElement.value;
    }

    redirectByQS(currentQSdict);
}

function resetFilter() {
  let currentQSdict = parseQueryString("in");
  if (Object.keys(currentQSdict).includes("category")) {
      delete currentQSdict["category"];
  }
  
  if (Object.keys(currentQSdict).includes("price-range")) {
      delete currentQSdict["price-range"];
  }

  if (Object.keys(currentQSdict).includes("status")) {
      delete currentQSdict["status"];
  }

  if (Object.keys(currentQSdict).includes("total-range")) {
      delete currentQSdict["total-range"];
  }

  redirectByQS(currentQSdict);
}

function redirectByQS(queryDict) {
    let newQueryString = parseQueryString("out", queryDict);
    let currentURL = window.location.origin + window.location.pathname;
    let newURL = currentURL + newQueryString;
    window.location = newURL;
}