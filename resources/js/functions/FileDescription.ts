import { filesize } from 'filesize';
import getFileType from '@/functions/GetFileType';
import type FileInfo from '@/types/app/FileInfo';
export default function fileDescription(file: FileInfo) {
    const extension = getFileType(file.name);
    const size = filesize(file.size, { standard: 'iec' });

    return `${extension} · ${size}`;
}
