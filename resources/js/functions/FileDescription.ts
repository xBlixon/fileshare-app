import { filesize } from 'filesize';
import getFileType from '@/functions/GetFileType';
export default function fileDescription(file: File) {
    const extension = getFileType(file.name);
    const size = filesize(file.size, { standard: 'iec' });

    return `${extension} · ${size}`;
}
