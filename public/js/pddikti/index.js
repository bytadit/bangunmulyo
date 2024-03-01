const hitMahasiswa = async (nim) => {
    return await fetch(`http://bukutamu.test/mahasiswa/${nim}`).then(
        async (res) => {
            const data = await res.json();
            if (data.length != 0) {
                return {
                    status: true,
                    data: {
                        nama: data.mahasiswa[0].text
                            .split(",")[0]
                            .split("(")[0],
                        prodi: data.mahasiswa[0].text
                            .split("Prodi: ")[1]
                            .split(",")[0],
                    },
                };
            }

            return {
                status: false,
            };
        }
    );
};
