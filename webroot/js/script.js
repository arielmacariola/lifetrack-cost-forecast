window.addEventListener("load", () => {
  const form = document.getElementById("formForcast");

  getForecastData = async () => {
    const location = window.location.hostname;
    const numOfStudyPerDay = document.getElementById("numOfStudyPerDay").value;
    const numOfStudyGrowthPerMonth = document.getElementById(
      "numOfStudyGrowthPerMonth"
    ).value;
    const numOfMonthsForecast = document.getElementById("numOfMonthsForecast")
      .value;

    const settings = {
      method: "post",
      headers: {
        Accept: "application/json",
        "Content-Type": "application/json"
      },
      body: JSON.stringify({
        numberOfStudiesPerDay: numOfStudyPerDay,
        growthPercentagePerMonth: numOfStudyGrowthPerMonth,
        numOfMonthForecast: numOfMonthsForecast
      })
    };
    try {
      const fetchResponse = await fetch(
        `http://${location}:8000/api.php`,
        settings
      );
      const data = await fetchResponse.json();
      return data;
    } catch (e) {
      return e;
    }
  };

  form.addEventListener("submit", e => {
    e.preventDefault();

    getForecastData().then(data => {
      const dataRows = data
        .map((row, index) => {
          return `<tr>
                <th scope="row">${index + 1}</th>
                <td>${row.monthYearLabel}</td>
                <td>${row.numOfStudiesThisMonth}</td>
                <td>${row.totalCostForcasted}</td>
            </tr>`;
        })
        .join("");

      // Insert result data in result container
      const resultBox = (document.querySelector(
        "#result table tbody"
      ).innerHTML = dataRows);
    });
  });
});
