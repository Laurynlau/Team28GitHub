const updateFilter = (filterName) => {
  const currentUrl = window.location.href;
  let newUrlParams = "";

  const filterValue = $(`#${filterName}`).val();

  if (filterValue === "all") {
    newUrlParams = removeUrlParam(filterName, currentUrl);
  } else {
    newUrlParams = setUrlParam(filterName, filterValue, currentUrl);
  }

  window.location.href =
    window.location.origin + window.location.pathname + "?" + newUrlParams;
};

const removeUrlParam = (paramToRemove, currentUrl) => {
  const url = new URL(currentUrl);
  const params = new URLSearchParams(url.search);
  params.delete(paramToRemove);
  return params;
};

const setUrlParam = (paramToSet, paramToSetValue, currentUrl) => {
  const url = new URL(currentUrl);
  const params = new URLSearchParams(url.search);
  params.set(paramToSet, paramToSetValue);
  return params;
};

const selectCurrentFilters = () => {
  const searchParams = new URLSearchParams(window.location.search);

  if (searchParams.has("category")) {
    const categoryValue = searchParams.get("category");
    $(`#category option[value="${categoryValue}"]`).attr("selected", true);
  }

  if (searchParams.has("price-range")) {
    const priceRangeValue = searchParams.get("price-range");
    $(`#price-range option[value="${priceRangeValue}"]`).attr("selected", true);
  }
};

$(document).ready(function () {
  selectCurrentFilters();

  $("#category").on("change", function () {
    updateFilter("category");
  });

  $("#price-range").on("change", function () {
    updateFilter("price-range");
  });
});
