import * as fs from "fs";
import users from "./users.json";

interface User {
    NIK: number;
    NAMA: string;
    JABATAN: string;
    USER: string;
    PASSWORD: string;
    ROLE: number;
    BIDANG: number;
}

function mapToJsonToTxt(users: User[]): string {
    const txtArray: string[] = [];

    users.forEach((user) => {
        const txt = `User::factory()->create([
            'role' => ${user.ROLE},
            'nama' => '${user.NAMA}',
            'username' => '${user.USER}',
            'nik' => '${user.NIK}',
            'password' => bcrypt('${user.PASSWORD}'),
            'bidang' => ${user.BIDANG}
        ]);`;

        txtArray.push(txt);
    });

    return txtArray.join("\n");
}

const result = mapToJsonToTxt(users);
// Specify the file path
const filePath = "output.txt";

// Write the result to the file
fs.writeFileSync(filePath, result);

console.log(`Output written to ${filePath}`);
