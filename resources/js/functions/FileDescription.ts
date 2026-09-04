import { filesize } from 'filesize';
import getFileType from '@/functions/GetFileType';
import type file from '@/types/app/file';
export default function fileDescription(file: file) {
    const extension = getFileType(file.name);
    const size = filesize(file.size, {standard: 'iec'});

    return `${extension} · ${size}`;
}
