import { formatRelative, format, isBefore, addHours, subDays } from 'date-fns';
import { pl, enUS } from 'date-fns/locale';

export default function formatSmartDate(dateInput: string | Date, locale = pl): string {
    const date = new Date(dateInput);
    const now = new Date();

    // Less than 24hrs ago
    if (addHours(date, 24) > now) {
        return formatRelative(date, now, { locale });
    }

    // More than 24hrs ago
    return format(date, 'dd.MM.yyyy, HH:mm:ss', { locale });
}
