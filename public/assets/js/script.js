document.addEventListener("DOMContentLoaded", function () {
    // // Kalender Side Start
    var calendarEl_side = document.getElementById("calendar_side");

    var calendar_side = new FullCalendar.Calendar(calendarEl_side, {
        timeZone: "Asia/Jakarta",
        themeSystem: "bootstrap5",
        headerToolbar: {
            left: false,
            center: "title",
            right: false,
        },
        dayMaxEvents: true,
        weekends: true,
        height: "350px",
        events: function (fetchInfo, successCallback, failureCallback) {
            // Ambil data event dari API
            axios
                .get("/api/events")
                .then((response) => {
                    const events = response.data.map((event) => {
                        if (event.type === "planning") {
                            return {
                                ...event,
                                backgroundColor: event.color, // Warna random untuk planning
                                borderColor: "transparent", // Hilangkan border jika perlu
                            };
                        } else if (event.type === "actual") {
                            return {
                                ...event,
                                backgroundColor: "#28a745", // Hijau untuk actual
                                borderColor: "#28a745", // Border hijau juga
                            };
                        }
                        return event; // Event tanpa kategori tetap default
                    });
                    successCallback([...events]);
                })
                .catch((error) => {
                    console.error("Error fetching events:", error);
                    failureCallback(error);
                });
        },
    });

    calendar_side.render();

    // Kalender Start
    var calendarEl = document.getElementById("calendar");

    // Function to check login status Select
    let checkLoginStatusSelect = function (info) {
        let end_date = new Date(info.end);
        end_date.setDate(end_date.getDate() - 1);
        let endStr = end_date.toISOString().split("T")[0];
        if (info.startStr !== endStr) {
            $.ajax({
                type: "GET",
                url: "/check-login",
                dataType: "json",
                success: function (response) {
                    if (response.isLoggedIn) {
                        // console.log(info.startStr + "&" + endStr);
                        axios
                            .get("/api/dropdown")
                            .then((response) => {
                                const options = response.data
                                    .map((option) => {
                                        return `<option value="${option.nama}">${option.nama}</option>`;
                                    })
                                    .join("");
                                // Tampilkan SweetAlert dengan dropdown
                                Swal.fire({
                                    title: "Pelaksanaan Kalibrasi Alat Ukur",
                                    html: `
                                        <select id="title" class="swal2-input" style="width: 261px;">
                                            <option value="">Pilih Alat Ukur</option>
                                            ${options}
                                        </select>
                                        <input type="text" id="description" class="swal2-input" placeholder="Deskripsi Kalibrasi"></input>
                                    `,
                                    focusConfirm: false,
                                    showCancelButton: true,
                                    confirmButtonText: "Simpan",
                                    preConfirm: () => {
                                        // Ambil nilai dari input
                                        const title =
                                            document.getElementById(
                                                "title"
                                            ).value;
                                        const description =
                                            document.getElementById(
                                                "description"
                                            ).value;
                                        if (!title) {
                                            Swal.showValidationMessage(
                                                "Judul harus diisi"
                                            );
                                            return false;
                                        }
                                        return { title, description };
                                    },
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        const eventData = result.value;
                                        axios
                                            .post("/api/events", {
                                                title: eventData.title,
                                                description:
                                                    eventData.description,
                                                start: info.startStr,
                                                end: info.endStr,
                                                type: "actual",
                                            })
                                            .then((response) => {
                                                // console.log(response);
                                                Swal.fire(
                                                    "Berhasil",
                                                    "Data berhasil ditambahkan!",
                                                    "success"
                                                );
                                                calendar.refetchEvents();
                                            })
                                            .catch((error) => {
                                                Swal.fire(
                                                    "Error",
                                                    "Gagal menyimpan event",
                                                    "error"
                                                );
                                                console.log(error);
                                            });
                                    }
                                });
                            })
                            .catch((error) => {
                                Swal.fire(
                                    "Error",
                                    "Gagal memuat data kategori",
                                    "error"
                                );
                                console.error(error);
                            });
                    } else {
                        console.log("not authenticate");
                    }
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    if (xhr.status == 401) {
                        return window.location.replace("/login");
                    }
                    // alert(xhr.status);
                    console.log(
                        xhr.status +
                            "\n" +
                            xhr.responseText +
                            "\n" +
                            thrownError
                    );
                    alert(
                        xhr.status +
                            "\n" +
                            xhr.responseText +
                            "\n" +
                            thrownError
                    );
                },
            });
        }
    };

    // Function to check login status Select
    let checkLoginStatusClick = function (info) {
        $.ajax({
            type: "GET",
            url: "/check-login",
            dataType: "json",
            success: function (response) {
                if (response.isLoggedIn) {
                    axios
                        .get("/api/dropdown")
                        .then((response) => {
                            // console.log(response);
                            // Data untuk dropdown
                            const options = response.data
                                .map((option) => {
                                    return `<option value="${option.nama}">${option.nama}</option>`;
                                })
                                .join("");

                            // Tampilkan SweetAlert dengan dropdown
                            Swal.fire({
                                title: "Pelaksanaan Kalibrasi Alat Ukur",
                                html: `
                                <select id="title" class="swal2-input" style="width: 261px;">
                                    <option value="">Pilih Alat Ukur</option>
                                    ${options}
                                </select>
                                <input type="text" id="description" class="swal2-input" placeholder="Deskripsi Kalibrasi"></input>
                            `,
                                focusConfirm: false,
                                showCancelButton: true,
                                confirmButtonText: "Simpan",
                                preConfirm: () => {
                                    // Ambil nilai dari input
                                    const title =
                                        document.getElementById("title").value;
                                    const description =
                                        document.getElementById(
                                            "description"
                                        ).value;

                                    if (!title) {
                                        Swal.showValidationMessage(
                                            "Judul harus diisi"
                                        );
                                        return false;
                                    }

                                    return { title, description };
                                },
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    const eventData = result.value;
                                    axios
                                        .post("/api/events", {
                                            title: eventData.title,
                                            description: eventData.description,
                                            start: info.dateStr,
                                            type: "actual",
                                        })
                                        .then((response) => {
                                            // console.log(response);
                                            Swal.fire(
                                                "Berhasil",
                                                "Data berhasil ditambahkan!",
                                                "success"
                                            );
                                            calendar.refetchEvents();
                                        })
                                        .catch((error) => {
                                            Swal.fire(
                                                "Error",
                                                "Gagal menyimpan event",
                                                "error"
                                            );
                                            console.log(error);
                                        });
                                }
                            });
                        })
                        .catch((error) => {
                            Swal.fire(
                                "Error",
                                "Gagal memuat data schedule",
                                "error"
                            );
                            console.error(error);
                        });
                } else {
                    console.log("not authenticate");
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                if (xhr.status == 401) {
                    return window.location.replace("/login");
                }
                // alert(xhr.status);
                console.log(
                    xhr.status + "\n" + xhr.responseText + "\n" + thrownError
                );
                alert(
                    xhr.status + "\n" + xhr.responseText + "\n" + thrownError
                );
            },
        });
    };

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: "multiMonthYear",
        plugins: [],
        locale: "id",
        buttonText: {
            year: "Tahun",
            month: "Bulan",
            week: "Minggu",
            day: "Hari",
            list: "Jadwal",
            today: "Hari Ini",
        },
        height: "auto",
        contentHeight: "auto",
        timeZone: "Asia/Jakarta",
        themeSystem: "bootstrap5",
        headerToolbar: {
            left: "prev,next today",
            center: "title",
            right: "multiMonthYear,dayGridMonth,timeGridWeek,timeGridDay,listMonth",
        },
        events: function (fetchInfo, successCallback, failureCallback) {
            // Ambil data event dari API
            axios
                .get("/api/events")
                .then((response) => {
                    // Array.isArray(response.data);
                    // const events = response.data;
                    // console.log([events]);
                    const events = response.data.map((event) => {
                        if (event.type === "planning") {
                            return {
                                ...event,
                                backgroundColor: event.color, // Warna random untuk planning
                                borderColor: "transparent", // Hilangkan border jika perlu
                            };
                        } else if (event.type === "actual") {
                            return {
                                ...event,
                                backgroundColor: "#28a745", // Hijau untuk actual
                                borderColor: "#28a745", // Border hijau juga
                            };
                        }
                        return event; // Event tanpa kategori tetap default
                    });
                    successCallback([...events]);
                })
                .catch((error) => {
                    console.error("Error fetching events:", error);
                    failureCallback(error);
                });
        },
        weekends: true,
        selectable: true,
        select: function (info) {
            checkLoginStatusSelect(info);
        },
        dateClick: function (info) {
            checkLoginStatusClick(info);
        },
    });

    calendar.render();
});
