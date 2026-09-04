export default function getFileType(filename: string): string {
    const lastDotIndex = filename.lastIndexOf('.');

    if (lastDotIndex === -1 || lastDotIndex === 0) {
        return '';
    }

    return filename.slice(lastDotIndex + 1).toUpperCase();
}
